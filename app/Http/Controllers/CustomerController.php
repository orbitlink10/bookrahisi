<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Business;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function register(): View
    {
        return view('customer-register', [
            'sideImage' => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?auto=format&fit=crop&w=1400&q=80',
        ]);
    }

    public function registerSubmit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number' => ['required', 'string', 'min:10', 'max:30'],
        ]);

        $customer = User::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'password' => $validated['password'],
            'is_admin' => false,
            'account_status' => 'active',
        ]);

        $request->session()->regenerate();
        $request->session()->put('customer_user_id', $customer->id);

        return redirect()
            ->route('customer.dashboard')
            ->with('customer_success', 'Your customer account is ready. You can now search businesses, manage bookings, and leave reviews.');
    }

    public function signIn(): View
    {
        return view('customer-sign-in', [
            'sideImage' => 'https://images.unsplash.com/photo-1515377905703-c4788e51af15?auto=format&fit=crop&w=1400&q=80',
        ]);
    }

    public function signInSubmit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $customer = User::query()
            ->where('email', $validated['email'])
            ->where('is_admin', false)
            ->where('account_status', 'active')
            ->first();

        if (! $customer || ! Hash::check($validated['password'], $customer->password)) {
            return redirect()
                ->route('customer.sign-in')
                ->withErrors(['email' => 'The customer credentials are invalid or the account is inactive.'])
                ->withInput($request->except('password'));
        }

        $request->session()->regenerate();
        $request->session()->put('customer_user_id', $customer->id);

        return redirect()->route('customer.dashboard');
    }

    public function signOut(Request $request): RedirectResponse
    {
        $request->session()->forget('customer_user_id');

        return redirect()->route('customer.sign-in');
    }

    public function dashboard(Request $request): View|RedirectResponse
    {
        $customer = $this->authenticatedCustomer($request);

        if (! $customer) {
            return redirect()->route('customer.sign-in');
        }

        $search = trim((string) $request->query('q', ''));
        $city = trim((string) $request->query('city', ''));
        $category = trim((string) $request->query('category', ''));

        $businesses = Business::query()
            ->where('approval_status', 'approved')
            ->withCount(['bookings', 'reviews'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($nestedQuery) use ($search) {
                    $nestedQuery
                        ->where('business_name', 'like', '%'.$search.'%')
                        ->orWhere('business_category', 'like', '%'.$search.'%')
                        ->orWhere('city', 'like', '%'.$search.'%')
                        ->orWhere('neighborhood', 'like', '%'.$search.'%');
                });
            })
            ->when($city !== '', fn ($query) => $query->where('city', $city))
            ->when($category !== '', fn ($query) => $query->where('business_category', $category))
            ->orderBy('business_name')
            ->get();

        $allBookings = Booking::query()
            ->with('business')
            ->where('customer_user_id', $customer->id)
            ->latest()
            ->get();

        $recentBookings = $allBookings->take(4);
        $upcomingBookings = $allBookings
            ->filter(fn (Booking $booking): bool => in_array($booking->status, ['pending', 'confirmed'], true))
            ->count();
        $completedBookings = $allBookings
            ->filter(fn (Booking $booking): bool => $booking->status === 'completed')
            ->count();
        $pendingPayments = $allBookings
            ->filter(fn (Booking $booking): bool => $booking->payment_status === 'pending')
            ->count();
        $reviewCount = Review::query()
            ->where('user_id', $customer->id)
            ->count();

        return view('customer-dashboard', [
            'businesses' => $businesses,
            'categories' => Business::query()
                ->where('approval_status', 'approved')
                ->distinct()
                ->orderBy('business_category')
                ->pluck('business_category'),
            'cities' => Business::query()
                ->where('approval_status', 'approved')
                ->distinct()
                ->orderBy('city')
                ->pluck('city'),
            'completedBookings' => $completedBookings,
            'customer' => $customer,
            'pendingPayments' => $pendingPayments,
            'recentBookings' => $recentBookings,
            'reviewCount' => $reviewCount,
            'searchCategory' => $category,
            'searchCity' => $city,
            'searchTerm' => $search,
            'upcomingBookings' => $upcomingBookings,
        ]);
    }

    public function bookings(Request $request): View|RedirectResponse
    {
        $customer = $this->authenticatedCustomer($request);

        if (! $customer) {
            return redirect()->route('customer.sign-in');
        }

        $bookings = Booking::query()
            ->with(['business', 'review'])
            ->where('customer_user_id', $customer->id)
            ->latest()
            ->get();

        return view('customer-bookings', [
            'bookings' => $bookings,
            'customer' => $customer,
        ]);
    }

    public function cancelBooking(Request $request, Booking $booking): RedirectResponse
    {
        $customer = $this->authenticatedCustomer($request);

        if (! $customer) {
            return redirect()->route('customer.sign-in');
        }

        if ((int) $booking->customer_user_id !== (int) $customer->id) {
            abort(403);
        }

        if (! in_array($booking->status, ['pending', 'confirmed'], true)) {
            return redirect()->to($this->bookingsAnchor('upcoming'))
                ->withErrors(['status' => 'Only pending or confirmed appointments can be cancelled.']);
        }

        $booking->update([
            'status' => 'cancelled',
        ]);

        return redirect()->to($this->bookingsAnchor('upcoming'))
            ->with('customer_success', 'Your appointment has been cancelled.');
    }

    public function submitReview(Request $request, Booking $booking): RedirectResponse
    {
        $customer = $this->authenticatedCustomer($request);

        if (! $customer) {
            return redirect()->route('customer.sign-in');
        }

        if ((int) $booking->customer_user_id !== (int) $customer->id) {
            abort(403);
        }

        if ($booking->status !== 'completed') {
            return redirect()->to($this->bookingsAnchor('history'))
                ->withErrors(['rating' => 'Only completed appointments can be reviewed.']);
        }

        if ($booking->review()->exists()) {
            return redirect()->to($this->bookingsAnchor('history'))
                ->withErrors(['rating' => 'A review has already been submitted for this appointment.']);
        }

        $validated = $request->validate([
            'rating' => ['required', 'integer', Rule::in([1, 2, 3, 4, 5])],
            'body' => ['required', 'string', 'max:600'],
        ]);

        $booking->review()->create([
            'business_id' => $booking->business_id,
            'user_id' => $customer->id,
            'rating' => $validated['rating'],
            'body' => $validated['body'],
        ]);

        return redirect()->to($this->bookingsAnchor('history'))
            ->with('customer_success', 'Your review has been published to the business page.');
    }

    private function authenticatedCustomer(Request $request): ?User
    {
        $customerId = $request->session()->get('customer_user_id');

        if (! $customerId) {
            return null;
        }

        return User::query()
            ->whereKey($customerId)
            ->where('is_admin', false)
            ->where('account_status', 'active')
            ->first();
    }

    private function bookingsAnchor(string $section): string
    {
        return route('customer.bookings').'#'.$section;
    }
}
