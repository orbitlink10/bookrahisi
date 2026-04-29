<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PublicSiteController extends Controller
{
    public function index(): View
    {
        $cities = [
            'Nairobi',
            'Mombasa',
            'Kisumu',
            'Nakuru',
            'Eldoret',
            'Thika',
            'Naivasha',
            'Malindi',
            'Kitale',
            'Machakos',
            'Kakamega',
            'Nyeri',
            'Meru',
            'Nanyuki',
            'Diani',
            'Kericho',
            'Kisii',
            'Embu',
            'Athi River',
            'Rongai',
        ];

        return view('home', [
            'hero' => [
                'title' => 'Book your next self-care session',
                'subtitle' => 'Discover salons, spas, barbershops, nail studios, massage therapy, and fitness classes across Kenya with instant online booking.',
                'image' => 'https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=1800&q=80',
            ],
            'servicePills' => [
                'Haircut & Style',
                'Hair Color',
                'Barber',
                'Spa',
                'Nail',
                'Yoga',
                'Massage',
                'Pilates',
                'More...',
            ],
            'trendingBusinesses' => [
                [
                    'name' => 'Amani Style Studio',
                    'category' => 'Salon',
                    'location' => 'Westlands, Nairobi',
                    'distance' => '1.2 km',
                    'rating' => '4.9',
                    'reviews' => '318 reviews',
                    'image' => 'https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?auto=format&fit=crop&w=900&q=80',
                ],
                [
                    'name' => 'Polished by Zuri',
                    'category' => 'Nail Studio',
                    'location' => 'Kilimani, Nairobi',
                    'distance' => '2.4 km',
                    'rating' => '4.8',
                    'reviews' => '204 reviews',
                    'image' => 'https://images.unsplash.com/photo-1610992239169-c57b2a6f98b1?auto=format&fit=crop&w=900&q=80',
                ],
                [
                    'name' => 'Baraka Grooming Club',
                    'category' => 'Barbershop',
                    'location' => 'Milimani, Kisumu',
                    'distance' => '0.9 km',
                    'rating' => '4.9',
                    'reviews' => '175 reviews',
                    'image' => 'https://images.unsplash.com/photo-1622286342621-4bd786c2447c?auto=format&fit=crop&w=900&q=80',
                ],
                [
                    'name' => 'Maua Spa House',
                    'category' => 'Spa',
                    'location' => 'Nyali, Mombasa',
                    'distance' => '1.7 km',
                    'rating' => '4.8',
                    'reviews' => '128 reviews',
                    'image' => 'https://images.unsplash.com/photo-1515377905703-c4788e51af15?auto=format&fit=crop&w=900&q=80',
                ],
                [
                    'name' => 'Iron District Fitness',
                    'category' => 'Gym',
                    'location' => 'Kilimani, Nairobi',
                    'distance' => '3.1 km',
                    'rating' => '4.7',
                    'reviews' => '96 reviews',
                    'image' => 'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&w=900&q=80',
                ],
            ],
            'dailyDeals' => [
                [
                    'title' => 'Radiance facial treatment',
                    'location' => 'Westlands, Nairobi',
                    'distance' => '1.4 km',
                    'badge' => 'Save 25%',
                    'image' => 'https://images.unsplash.com/photo-1519823551278-64ac92734fb1?auto=format&fit=crop&w=1200&q=80',
                ],
                [
                    'title' => 'Executive barber refresh',
                    'location' => 'Karen, Nairobi',
                    'distance' => '4.2 km',
                    'badge' => 'Save 15%',
                    'image' => 'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?auto=format&fit=crop&w=1200&q=80',
                ],
                [
                    'title' => 'Energy healing body work',
                    'location' => 'Nyali, Mombasa',
                    'distance' => '2.3 km',
                    'badge' => 'Up to 20% off',
                    'image' => 'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?auto=format&fit=crop&w=1200&q=80',
                ],
                [
                    'title' => 'Weekend lash special',
                    'location' => 'Nakuru CBD',
                    'distance' => '0.8 km',
                    'badge' => 'Up to 30% off',
                    'image' => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?auto=format&fit=crop&w=1200&q=80',
                ],
                [
                    'title' => 'Brightening glow mask',
                    'location' => 'Kisumu CBD',
                    'distance' => '1.1 km',
                    'badge' => 'Save KES 1,000',
                    'image' => 'https://images.unsplash.com/photo-1596178065887-1198b6148b2b?auto=format&fit=crop&w=1200&q=80',
                ],
                [
                    'title' => 'Deep tissue reset',
                    'location' => 'Diani Beach',
                    'distance' => '3.8 km',
                    'badge' => '30% off',
                    'image' => 'https://images.unsplash.com/photo-1515377905703-c4788e51af15?auto=format&fit=crop&w=1200&q=80',
                ],
                [
                    'title' => 'Luxury nails and chrome finish',
                    'location' => 'Kilimani, Nairobi',
                    'distance' => '1.6 km',
                    'badge' => 'Up to KES 2,000 off',
                    'image' => 'https://images.unsplash.com/photo-1607779097040-26e80aa4576c?auto=format&fit=crop&w=1200&q=80',
                ],
                [
                    'title' => 'First visit gym pass',
                    'location' => 'Eldoret Town',
                    'distance' => '2.5 km',
                    'badge' => '50% off',
                    'image' => 'https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?auto=format&fit=crop&w=1200&q=80',
                ],
            ],
            'cityColumns' => array_chunk($cities, 5),
        ]);
    }

    public function forBusiness(): View
    {
        return view('for-business', [
            'businessTypeGallery' => [
                [
                    'title' => 'Salon',
                    'image' => 'https://images.unsplash.com/photo-1562322140-8baeececf3df?auto=format&fit=crop&w=1400&q=80',
                    'show_arrow' => false,
                ],
                [
                    'title' => 'Barber',
                    'image' => 'https://images.unsplash.com/photo-1622286342621-4bd786c2447c?auto=format&fit=crop&w=1400&q=80',
                    'show_arrow' => false,
                ],
                [
                    'title' => 'Nails',
                    'image' => 'https://images.unsplash.com/photo-1604902396830-aca29e19b067?auto=format&fit=crop&w=1400&q=80',
                    'show_arrow' => false,
                ],
                [
                    'title' => 'Spa & sauna',
                    'image' => 'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?auto=format&fit=crop&w=1400&q=80',
                    'show_arrow' => false,
                ],
                [
                    'title' => 'Medspa',
                    'image' => 'https://images.unsplash.com/photo-1582095133179-bfd08e2fc6b3?auto=format&fit=crop&w=1400&q=80',
                    'show_arrow' => false,
                ],
                [
                    'title' => 'Massage',
                    'image' => 'https://images.unsplash.com/photo-1515377905703-c4788e51af15?auto=format&fit=crop&w=1400&q=80',
                    'show_arrow' => false,
                ],
                [
                    'title' => 'Fitness & recovery',
                    'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=1400&q=80',
                    'show_arrow' => true,
                ],
                [
                    'title' => 'Physical therapy',
                    'image' => 'https://images.unsplash.com/photo-1666214280557-f1b5022eb634?auto=format&fit=crop&w=1400&q=80',
                    'show_arrow' => false,
                ],
                [
                    'title' => 'Health practice',
                    'image' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=1400&q=80',
                    'show_arrow' => false,
                ],
                [
                    'title' => 'Tattoo & piercing',
                    'image' => 'https://images.unsplash.com/photo-1543248939-ff40856f65d4?auto=format&fit=crop&w=1400&q=80',
                    'show_arrow' => true,
                ],
                [
                    'title' => 'Pet grooming',
                    'image' => 'https://images.unsplash.com/photo-1516734212186-a967f81ad0d7?auto=format&fit=crop&w=1400&q=80',
                    'show_arrow' => false,
                ],
                [
                    'title' => 'Tanning studio',
                    'image' => 'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&w=1400&q=80',
                    'show_arrow' => false,
                ],
            ],
            'businessTypes' => [
                [
                    'title' => 'Salons',
                    'description' => 'Manage stylists, chairs, color appointments, retail add-ons, and repeat clients from one dashboard.',
                ],
                [
                    'title' => 'Spas',
                    'description' => 'Coordinate treatment rooms, therapists, packages, deposits, and no-show protection without manual follow-up.',
                ],
                [
                    'title' => 'Barbershops',
                    'description' => 'Run bookings, walk-ins, staff schedules, and customer reminders with a faster front-desk workflow.',
                ],
                [
                    'title' => 'Fitness studios',
                    'description' => 'Offer classes, private sessions, trainer availability, and recurring bookings in a single booking flow.',
                ],
            ],
            'features' => [
                'Online booking with live availability',
                'M-Pesa-ready payments and deposit collection',
                'Staff calendars and service assignment',
                'Customer reminders by email, SMS, and WhatsApp',
                'Reports for bookings, revenue, and performance',
                'Marketplace discovery for new customer growth',
            ],
            'plans' => [
                [
                    'name' => 'Starter',
                    'price' => 'Free to join',
                    'description' => 'Get listed on Book Rahisi and start receiving online booking requests.',
                ],
                [
                    'name' => 'Growth',
                    'price' => 'From KES 3,500 / month',
                    'description' => 'Unlock staff management, payments, reminders, and deeper reporting for busy businesses.',
                ],
            ],
        ]);
    }

    public function businessSignIn(): View
    {
        return view('for-business-sign-in', [
            'sideImage' => 'https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=1400&q=80',
        ]);
    }

    public function businessSignInSubmit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $request->session()->put('business_signup_email', $validated['email']);

        $business = $this->findOwnedBusinessByEmail($validated['email']);

        if ($business) {
            $this->syncOwnerSessionFromBusiness($request, $business);

            return redirect()->route('for-business.tools');
        }

        return redirect()->route('for-business.account-setup');
    }

    public function businessAccountSetup(Request $request): View|RedirectResponse
    {
        $email = $request->session()->get('business_signup_email');

        if (! $email) {
            return redirect()->route('for-business.sign-in');
        }

        $this->hydrateOwnerSessionFromDatabase($request);

        return view('for-business-account-setup', [
            'accountSetup' => $request->session()->get('business_account_setup', []),
            'businessCategories' => [
                'Salon',
                'Spa',
                'Barbershop',
                'Nail studio',
                'Massage therapy',
                'Fitness studio',
            ],
            'email' => $email,
            'sideImage' => 'https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?auto=format&fit=crop&w=1400&q=80',
        ]);
    }

    public function businessAccountSetupSubmit(Request $request): RedirectResponse
    {
        $email = $request->session()->get('business_signup_email');

        if (! $email) {
            return redirect()->route('for-business.sign-in');
        }

        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:80'],
            'last_name' => ['required', 'string', 'max:80'],
            'business_name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'min:10', 'max:30'],
            'business_category' => ['required', 'string', 'max:80'],
        ]);

        $existingBusiness = $this->findOwnedBusinessByEmail($email);
        $slug = Str::slug($validated['business_name']);
        $slugTaken = Business::query()
            ->where('slug', $slug)
            ->when($existingBusiness, static fn ($query) => $query->whereKeyNot($existingBusiness->id))
            ->exists();

        if ($slugTaken) {
            return redirect()
                ->route('for-business.account-setup')
                ->withErrors(['business_name' => 'That business name is already in use. Choose a different name to continue.'])
                ->withInput();
        }

        $request->session()->put('business_account_setup', $validated);

        return redirect()->route('for-business.business-setup');
    }

    public function businessProfileSetup(Request $request): View|RedirectResponse
    {
        $email = $request->session()->get('business_signup_email');

        if (! $email) {
            return redirect()->route('for-business.sign-in');
        }

        $this->hydrateOwnerSessionFromDatabase($request);

        $accountSetup = $request->session()->get('business_account_setup');

        if (! is_array($accountSetup) || $accountSetup === []) {
            return redirect()->route('for-business.account-setup');
        }

        return view('for-business-business-setup', [
            'accountSetup' => $accountSetup,
            'email' => $email,
            'nextSteps' => [
                'Add your business location and service areas',
                'Set operating hours and booking notice rules',
                'Create your first services and staff profiles',
                'Turn on public booking when you are ready to go live',
            ],
            'sideImage' => 'https://images.unsplash.com/photo-1487412912498-0447578fcca8?auto=format&fit=crop&w=1400&q=80',
        ]);
    }

    public function businessTools(Request $request): View|RedirectResponse
    {
        $email = $request->session()->get('business_signup_email');

        if (! $email) {
            return redirect()->route('for-business.sign-in');
        }

        $this->hydrateOwnerSessionFromDatabase($request);

        $accountSetup = $request->session()->get('business_account_setup');
        $profileDetails = $request->session()->get('business_profile_details', []);

        if (! is_array($accountSetup) || $accountSetup === []) {
            return redirect()->route('for-business.account-setup');
        }

        $businessSlug = Str::slug($accountSetup['business_name']);
        $profileReady = is_array($profileDetails) && $profileDetails !== [];
        $business = $this->findOwnedBusinessByEmail($email);
        $bookingCount = $business?->bookings()->count() ?? 0;
        $pendingBookingCount = $business?->bookings()->where('status', 'pending')->count() ?? 0;
        $todayBookingCount = $business?->bookings()->whereDate('appointment_date', today())->count() ?? 0;
        $recentBookings = $business
            ? $business->bookings()->latest()->take(4)->get()
            : collect();

        return view('for-business-tools', [
            'accountSetup' => $accountSetup,
            'bookingCount' => $bookingCount,
            'businessSlug' => $businessSlug,
            'email' => $email,
            'pendingBookingCount' => $pendingBookingCount,
            'profileReady' => $profileReady,
            'profileDetails' => $profileDetails,
            'recentBookings' => $recentBookings,
            'sideImage' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=1400&q=80',
            'todayBookingCount' => $todayBookingCount,
        ]);
    }

    public function businessProfileDetails(Request $request): View|RedirectResponse
    {
        $email = $request->session()->get('business_signup_email');

        if (! $email) {
            return redirect()->route('for-business.sign-in');
        }

        $this->hydrateOwnerSessionFromDatabase($request);

        $accountSetup = $request->session()->get('business_account_setup');

        if (! is_array($accountSetup) || $accountSetup === []) {
            return redirect()->route('for-business.account-setup');
        }

        return view('for-business-profile-details', [
            'accountSetup' => $accountSetup,
            'businessSlug' => Str::slug($accountSetup['business_name']),
            'email' => $email,
            'profileDetails' => $request->session()->get('business_profile_details', []),
            'sideImage' => 'https://images.unsplash.com/photo-1493256338651-d82f7acb2b38?auto=format&fit=crop&w=1400&q=80',
        ]);
    }

    public function businessProfileDetailsSubmit(Request $request): RedirectResponse
    {
        $email = $request->session()->get('business_signup_email');

        if (! $email) {
            return redirect()->route('for-business.sign-in');
        }

        $this->hydrateOwnerSessionFromDatabase($request);

        $accountSetup = $request->session()->get('business_account_setup');

        if (! is_array($accountSetup) || $accountSetup === []) {
            return redirect()->route('for-business.account-setup');
        }

        $validated = $request->validate([
            'tagline' => ['required', 'string', 'max:120'],
            'address_line' => ['required', 'string', 'max:160'],
            'city' => ['required', 'string', 'max:80'],
            'neighborhood' => ['required', 'string', 'max:80'],
            'opening_time' => ['required', 'date_format:H:i'],
            'closing_time' => ['required', 'date_format:H:i', 'after:opening_time'],
            'about' => ['required', 'string', 'max:1000'],
        ]);

        $request->session()->put('business_profile_details', $validated);

        $business = Business::query()->updateOrCreate(
            ['owner_email' => $email],
            [
                'owner_first_name' => $accountSetup['first_name'],
                'owner_last_name' => $accountSetup['last_name'],
                'business_name' => $accountSetup['business_name'],
                'slug' => Str::slug($accountSetup['business_name']),
                'phone' => $accountSetup['phone'],
                'business_category' => $accountSetup['business_category'],
                'tagline' => $validated['tagline'],
                'address_line' => $validated['address_line'],
                'city' => $validated['city'],
                'neighborhood' => $validated['neighborhood'],
                'opening_time' => $validated['opening_time'],
                'closing_time' => $validated['closing_time'],
                'about' => $validated['about'],
            ]
        );

        $this->syncOwnerSessionFromBusiness($request, $business);

        return redirect()
            ->route('for-business.tools')
            ->with('dashboard_success', 'Profile saved. Your business dashboard has been updated.');
    }

    public function publicBusinessProfile(Request $request, string $slug): View|RedirectResponse
    {
        $business = $this->findMarketplaceBusinessBySlug($request, $slug);
        $accountSetup = $this->accountSetupFromBusiness($business);
        $profileDetails = $this->profileDetailsFromBusiness($business);

        $location = $profileDetails['neighborhood'].', '.$profileDetails['city'];
        $reviews = $this->previewReviews($accountSetup['business_category']);
        $reviewSummary = $this->previewReviewSummary($reviews);
        $mapData = $this->previewMapData($profileDetails['city'], $profileDetails['neighborhood']);

        return view('business-public-profile', [
            'aboutHeading' => 'About '.$accountSetup['business_name'],
            'accountSetup' => $accountSetup,
            'additionalInformation' => $this->previewAdditionalInformation($accountSetup['business_category']),
            'addressLine' => $profileDetails['address_line'].', '.$location,
            'businessSlug' => $business->slug,
            'directionsUrl' => 'https://www.google.com/maps/search/?api=1&query='.urlencode($profileDetails['address_line'].', '.$location),
            'email' => $business->owner_email,
            'galleryImages' => $this->previewGalleryImages($accountSetup['business_category']),
            'location' => $location,
            'mapEmbedUrl' => $mapData['embed_url'],
            'openSummary' => 'Open today from '.$this->formatDisplayTime($profileDetails['opening_time']).' to '.$this->formatDisplayTime($profileDetails['closing_time']),
            'profileDetails' => $profileDetails,
            'rating' => $reviewSummary['rating'],
            'reviewCount' => $reviewSummary['count'],
            'reviews' => $reviews,
            'serviceFilters' => $this->previewServiceFilters($accountSetup['business_category']),
            'services' => $this->previewServices($accountSetup['business_category']),
            'tabs' => ['Photos', 'Services', 'Team', 'Reviews', 'Portfolio', 'About'],
            'teamMembers' => $this->previewTeamMembers($accountSetup['business_category']),
            'weeklyHours' => $this->previewWeeklyHours($profileDetails['opening_time'], $profileDetails['closing_time']),
        ]);
    }

    public function businessBooking(Request $request, string $slug): View|RedirectResponse
    {
        $business = $this->findMarketplaceBusinessBySlug($request, $slug);
        $accountSetup = $this->accountSetupFromBusiness($business);
        $profileDetails = $this->profileDetailsFromBusiness($business);

        $services = $this->previewServices($accountSetup['business_category']);
        $staffMembers = $this->previewBookingStaff($this->previewTeamMembers($accountSetup['business_category']));
        $selectedService = $this->resolvePreviewService($services, $request->query('service'));
        $selectedStaff = $this->resolvePreviewStaff($staffMembers, $request->query('staff'));

        return view('business-booking', [
            'accountSetup' => $accountSetup,
            'addressLine' => $profileDetails['address_line'].', '.$profileDetails['neighborhood'].', '.$profileDetails['city'],
            'bookingDates' => $this->previewBookingDates(),
            'businessSlug' => $business->slug,
            'openSummary' => 'Open today from '.$this->formatDisplayTime($profileDetails['opening_time']).' to '.$this->formatDisplayTime($profileDetails['closing_time']),
            'profileDetails' => $profileDetails,
            'selectedService' => $selectedService,
            'selectedStaff' => $selectedStaff,
            'services' => $services,
            'staffMembers' => $staffMembers,
            'timeSlots' => $this->previewBookingTimeSlots($profileDetails['opening_time'], $profileDetails['closing_time']),
        ]);
    }

    public function businessBookingSubmit(Request $request, string $slug): RedirectResponse
    {
        $business = $this->findMarketplaceBusinessBySlug($request, $slug);
        $accountSetup = $this->accountSetupFromBusiness($business);
        $profileDetails = $this->profileDetailsFromBusiness($business);
        $services = $this->previewServices($accountSetup['business_category']);
        $staffMembers = $this->previewBookingStaff($this->previewTeamMembers($accountSetup['business_category']));
        $bookingDates = $this->previewBookingDates();
        $timeSlots = $this->previewBookingTimeSlots($profileDetails['opening_time'], $profileDetails['closing_time']);

        $validated = $request->validate([
            'service' => ['required', 'string', 'max:120', Rule::in(array_map(static fn (array $service): string => Str::slug($service['name']), $services))],
            'appointment_date' => ['required', 'date', Rule::in(array_column($bookingDates, 'value'))],
            'appointment_time' => ['required', 'string', 'max:20', Rule::in($timeSlots)],
            'staff' => ['required', 'string', 'max:120', Rule::in(array_column($staffMembers, 'slug'))],
            'customer_name' => ['required', 'string', 'max:100'],
            'customer_phone' => ['required', 'string', 'max:30'],
            'customer_notes' => ['nullable', 'string', 'max:500'],
        ]);

        $selectedService = $this->resolvePreviewService($services, $validated['service']);
        $selectedStaff = $this->resolvePreviewStaff($staffMembers, $validated['staff']);

        $business->bookings()->create([
            'service_slug' => $selectedService['slug'],
            'service_name' => $selectedService['name'],
            'appointment_date' => $validated['appointment_date'],
            'appointment_time' => $validated['appointment_time'],
            'staff_slug' => $selectedStaff['slug'],
            'staff_name' => $selectedStaff['name'],
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'customer_notes' => $validated['customer_notes'] ?: null,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('business.book', [
                'slug' => $business->slug,
                'service' => $validated['service'],
                'staff' => $validated['staff'],
            ])
            ->with('booking_success', 'Booking request received. The business owner can now review it from their bookings page.');
    }

    public function businessBookings(Request $request): View|RedirectResponse
    {
        $email = $request->session()->get('business_signup_email');

        if (! $email) {
            return redirect()->route('for-business.sign-in');
        }

        $this->hydrateOwnerSessionFromDatabase($request);

        $accountSetup = $request->session()->get('business_account_setup');

        if (! is_array($accountSetup) || $accountSetup === []) {
            return redirect()->route('for-business.account-setup');
        }

        $business = $this->findOwnedBusinessByEmail($email);

        if (! $business) {
            return redirect()->route('for-business.profile-details');
        }

        $bookings = $business->bookings()
            ->latest()
            ->get();

        return view('for-business-bookings', [
            'accountSetup' => $this->accountSetupFromBusiness($business),
            'bookings' => $bookings,
            'businessSlug' => $business->slug,
            'email' => $business->owner_email,
            'sideImage' => 'https://images.unsplash.com/photo-1487412912498-0447578fcca8?auto=format&fit=crop&w=1400&q=80',
        ]);
    }

    private function hydrateOwnerSessionFromDatabase(Request $request): void
    {
        $email = $request->session()->get('business_signup_email');

        if (! $email) {
            return;
        }

        $business = $this->findOwnedBusinessByEmail($email);

        if (! $business) {
            return;
        }

        $this->syncOwnerSessionFromBusiness($request, $business);
    }

    private function syncOwnerSessionFromBusiness(Request $request, Business $business): void
    {
        $request->session()->put('business_signup_email', $business->owner_email);
        $request->session()->put('business_account_setup', $this->accountSetupFromBusiness($business));
        $request->session()->put('business_profile_details', $this->profileDetailsFromBusiness($business));
    }

    private function findOwnedBusinessByEmail(?string $email): ?Business
    {
        if (! $email) {
            return null;
        }

        return Business::query()
            ->where('owner_email', $email)
            ->first();
    }

    private function findMarketplaceBusinessBySlug(Request $request, string $slug): Business
    {
        $business = Business::query()
            ->where('slug', $slug)
            ->firstOrFail();

        if ($business->approval_status === 'approved' || $this->ownerCanPreviewBusiness($request, $business)) {
            return $business;
        }

        abort(404);
    }

    private function ownerCanPreviewBusiness(Request $request, Business $business): bool
    {
        return $request->session()->get('business_signup_email') === $business->owner_email;
    }

    private function accountSetupFromBusiness(Business $business): array
    {
        return [
            'first_name' => $business->owner_first_name,
            'last_name' => $business->owner_last_name,
            'business_name' => $business->business_name,
            'phone' => $business->phone,
            'business_category' => $business->business_category,
        ];
    }

    private function profileDetailsFromBusiness(Business $business): array
    {
        return [
            'tagline' => $business->tagline,
            'address_line' => $business->address_line,
            'city' => $business->city,
            'neighborhood' => $business->neighborhood,
            'opening_time' => substr((string) $business->opening_time, 0, 5),
            'closing_time' => substr((string) $business->closing_time, 0, 5),
            'about' => $business->about,
        ];
    }

    private function previewGalleryImages(string $category): array
    {
        return match ($category) {
            'Massage therapy' => [
                'https://images.unsplash.com/photo-1515377905703-c4788e51af15?auto=format&fit=crop&w=1400&q=80',
                'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?auto=format&fit=crop&w=1400&q=80',
                'https://images.unsplash.com/photo-1519823551278-64ac92734fb1?auto=format&fit=crop&w=1400&q=80',
            ],
            'Spa' => [
                'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?auto=format&fit=crop&w=1400&q=80',
                'https://images.unsplash.com/photo-1515377905703-c4788e51af15?auto=format&fit=crop&w=1400&q=80',
                'https://images.unsplash.com/photo-1519823551278-64ac92734fb1?auto=format&fit=crop&w=1400&q=80',
            ],
            'Barbershop' => [
                'https://images.unsplash.com/photo-1622286342621-4bd786c2447c?auto=format&fit=crop&w=1400&q=80',
                'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?auto=format&fit=crop&w=1400&q=80',
                'https://images.unsplash.com/photo-1512690459411-b0fd1c86b8c8?auto=format&fit=crop&w=1400&q=80',
            ],
            'Fitness studio' => [
                'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=1400&q=80',
                'https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?auto=format&fit=crop&w=1400&q=80',
                'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&w=1400&q=80',
            ],
            'Nail studio' => [
                'https://images.unsplash.com/photo-1604902396830-aca29e19b067?auto=format&fit=crop&w=1400&q=80',
                'https://images.unsplash.com/photo-1610992239169-c57b2a6f98b1?auto=format&fit=crop&w=1400&q=80',
                'https://images.unsplash.com/photo-1607779097040-26e80aa4576c?auto=format&fit=crop&w=1400&q=80',
            ],
            default => [
                'https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&w=1400&q=80',
                'https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?auto=format&fit=crop&w=1400&q=80',
                'https://images.unsplash.com/photo-1604654894610-df63bc536371?auto=format&fit=crop&w=1400&q=80',
            ],
        };
    }

    private function previewServiceFilters(string $category): array
    {
        return match ($category) {
            'Salon' => ['Featured', 'Barbershop', 'Hair Care & Styling', 'Facial Treatment', 'Massage', 'Waxing', 'Nail Care'],
            'Massage therapy' => ['Featured', 'Relaxation massage', 'Deep tissue', 'Couples', 'Wellness packages'],
            'Spa' => ['Featured', 'Facials', 'Body treatments', 'Packages', 'Memberships'],
            'Barbershop' => ['Featured', 'Haircuts', 'Beard care', 'Packages', 'Memberships'],
            'Fitness studio' => ['Featured', 'Personal training', 'Classes', 'Recovery', 'Packages'],
            'Nail studio' => ['Featured', 'Manicure', 'Pedicure', 'Nail art', 'Packages'],
            default => ['Featured', 'Signature services', 'Packages', 'Popular', 'New client offers'],
        };
    }

    private function previewServices(string $category): array
    {
        return match ($category) {
            'Salon' => [
                ['name' => 'Head and Shoulder Massage', 'duration' => '15 mins', 'price' => 'Ksh 600'],
                ['name' => 'Eyebrow threading', 'duration' => '10 mins', 'price' => 'Ksh 400'],
                ['name' => 'Hair undo', 'duration' => '1 hr', 'price' => 'Ksh 500'],
            ],
            'Massage therapy' => [
                ['name' => 'Deep tissue recovery session', 'duration' => '1 hr', 'price' => 'KES 4,500'],
                ['name' => 'Aromatherapy relaxation massage', 'duration' => '1 hr 15 min', 'price' => 'KES 5,200'],
                ['name' => 'Hot stone full-body release', 'duration' => '1 hr 30 min', 'price' => 'KES 6,000'],
            ],
            'Spa' => [
                ['name' => 'Glow reset facial', 'duration' => '50 min', 'price' => 'KES 3,900'],
                ['name' => 'Detox body polish', 'duration' => '1 hr', 'price' => 'KES 4,800'],
                ['name' => 'Signature spa package', 'duration' => '2 hr', 'price' => 'KES 8,500'],
            ],
            'Barbershop' => [
                ['name' => 'Executive haircut and finish', 'duration' => '45 min', 'price' => 'KES 1,500'],
                ['name' => 'Beard sculpt and hot towel', 'duration' => '30 min', 'price' => 'KES 900'],
                ['name' => 'Cut, beard, and scalp treatment', 'duration' => '1 hr', 'price' => 'KES 2,400'],
            ],
            'Fitness studio' => [
                ['name' => 'One-on-one strength coaching', 'duration' => '1 hr', 'price' => 'KES 3,500'],
                ['name' => 'Mobility and recovery session', 'duration' => '45 min', 'price' => 'KES 2,200'],
                ['name' => 'Weekly transformation package', 'duration' => '4 sessions', 'price' => 'KES 12,000'],
            ],
            'Nail studio' => [
                ['name' => 'Luxury gel manicure', 'duration' => '1 hr', 'price' => 'KES 2,300'],
                ['name' => 'Spa pedicure and polish', 'duration' => '1 hr 10 min', 'price' => 'KES 2,900'],
                ['name' => 'Chrome nail art set', 'duration' => '1 hr 20 min', 'price' => 'KES 3,400'],
            ],
            default => [
                ['name' => 'Signature beauty session', 'duration' => '1 hr', 'price' => 'KES 2,500'],
                ['name' => 'Consultation and treatment', 'duration' => '45 min', 'price' => 'KES 1,800'],
                ['name' => 'Premium package', 'duration' => '1 hr 30 min', 'price' => 'KES 4,700'],
            ],
        };
    }

    private function previewTeamMembers(string $category): array
    {
        return match ($category) {
            'Massage therapy', 'Spa' => [
                ['name' => 'Aisha', 'role' => 'Senior Therapist', 'rating' => '5.0', 'image' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=400&q=80'],
                ['name' => 'Njeri', 'role' => 'Wellness Specialist', 'rating' => '4.9', 'image' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&w=400&q=80'],
                ['name' => 'Maya', 'role' => 'Bodywork Expert', 'rating' => '4.8', 'image' => 'https://images.unsplash.com/photo-1488426862026-3ee34a7d66df?auto=format&fit=crop&w=400&q=80'],
                ['name' => 'Tina', 'role' => 'Guest Care', 'rating' => '4.9', 'image' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=400&q=80'],
            ],
            'Barbershop' => [
                ['name' => 'Brian', 'role' => 'Lead Barber', 'rating' => '5.0', 'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80'],
                ['name' => 'Kevin', 'role' => 'Fade Specialist', 'rating' => '4.9', 'image' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=400&q=80'],
                ['name' => 'Ian', 'role' => 'Beard Grooming', 'rating' => '4.8', 'image' => 'https://images.unsplash.com/photo-1504257432389-52343af06ae3?auto=format&fit=crop&w=400&q=80'],
                ['name' => 'Alex', 'role' => 'Junior Barber', 'rating' => '4.7', 'image' => 'https://images.unsplash.com/photo-1504593811423-6dd665756598?auto=format&fit=crop&w=400&q=80'],
            ],
            'Fitness studio' => [
                ['name' => 'Lorna', 'role' => 'Head Coach', 'rating' => '5.0', 'image' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=400&q=80'],
                ['name' => 'Sam', 'role' => 'Mobility Trainer', 'rating' => '4.8', 'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80'],
                ['name' => 'Diana', 'role' => 'Recovery Coach', 'rating' => '4.9', 'image' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=400&q=80'],
                ['name' => 'Tom', 'role' => 'Performance Trainer', 'rating' => '4.7', 'image' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=400&q=80'],
            ],
            default => [
                ['name' => 'Zuri', 'role' => 'Senior Specialist', 'rating' => '5.0', 'image' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=400&q=80'],
                ['name' => 'Faith', 'role' => 'Lead Stylist', 'rating' => '4.9', 'image' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&w=400&q=80'],
                ['name' => 'Milly', 'role' => 'Nail Technician', 'rating' => '4.8', 'image' => 'https://images.unsplash.com/photo-1488426862026-3ee34a7d66df?auto=format&fit=crop&w=400&q=80'],
                ['name' => 'Anne', 'role' => 'Guest Relations', 'rating' => '4.7', 'image' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=400&q=80'],
            ],
        };
    }

    private function previewReviews(string $category): array
    {
        return match ($category) {
            'Salon' => [
                [
                    'name' => 'Aparna C',
                    'date' => 'Fri, 24 Jan 2025 at 10:31pm',
                    'rating' => 4,
                    'body' => 'But please let us know if you have any clients before and if service will take longer than expected.',
                    'avatar_image' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=180&q=80',
                ],
                [
                    'name' => 'Becky A',
                    'date' => 'Sat, 28 Dec 2024 at 6:05pm',
                    'rating' => 5,
                    'body' => 'Excellent service and a calm atmosphere from the moment I walked in.',
                    'avatar_initials' => 'BA',
                    'avatar_color' => '#2f6df6',
                ],
                [
                    'name' => 'Becky A',
                    'date' => 'Thu, 27 Apr 2023 at 9:17pm',
                    'rating' => 5,
                    'body' => 'Beautiful place, great customer service and the service is worth the money spent.',
                    'avatar_initials' => 'BA',
                    'avatar_color' => '#2f6df6',
                ],
                [
                    'name' => 'Aparna C',
                    'date' => 'Thu, 20 Feb 2025 at 9:28am',
                    'rating' => 4,
                    'body' => 'Friendly team, quick check-in, and the salon left me feeling refreshed.',
                    'avatar_image' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=180&q=80',
                ],
            ],
            'Massage therapy', 'Spa' => [
                [
                    'name' => 'Mercy K',
                    'date' => 'Mon, 17 Feb 2025 at 7:15pm',
                    'rating' => 5,
                    'body' => 'The massage pressure was perfect and the room felt quiet, clean, and professional.',
                    'avatar_image' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&w=180&q=80',
                ],
                [
                    'name' => 'Joan W',
                    'date' => 'Sat, 1 Feb 2025 at 1:10pm',
                    'rating' => 5,
                    'body' => 'Excellent therapists and a very smooth booking process from start to finish.',
                    'avatar_image' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=180&q=80',
                ],
                [
                    'name' => 'Susan A',
                    'date' => 'Thu, 23 Jan 2025 at 11:20am',
                    'rating' => 4,
                    'body' => 'Great value and a relaxing atmosphere. I would book again.',
                    'avatar_initials' => 'SA',
                    'avatar_color' => '#3a8f58',
                ],
                [
                    'name' => 'Diana N',
                    'date' => 'Tue, 7 Jan 2025 at 5:42pm',
                    'rating' => 5,
                    'body' => 'The front desk was attentive and the treatment quality was excellent.',
                    'avatar_initials' => 'DN',
                    'avatar_color' => '#8b61ff',
                ],
            ],
            default => [
                [
                    'name' => 'Tina M',
                    'date' => 'Fri, 14 Feb 2025 at 4:40pm',
                    'rating' => 5,
                    'body' => 'Clean space, friendly team, and a service menu that matched exactly what was shown online.',
                    'avatar_image' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=180&q=80',
                ],
                [
                    'name' => 'Mark K',
                    'date' => 'Tue, 11 Feb 2025 at 10:05am',
                    'rating' => 4,
                    'body' => 'Professional service and a smooth check-in experience. I would recommend it.',
                    'avatar_initials' => 'MK',
                    'avatar_color' => '#3856e8',
                ],
                [
                    'name' => 'Lorna A',
                    'date' => 'Sun, 2 Feb 2025 at 3:18pm',
                    'rating' => 5,
                    'body' => 'Loved the atmosphere and how clearly the team explained each treatment option.',
                    'avatar_image' => 'https://images.unsplash.com/photo-1488426862026-3ee34a7d66df?auto=format&fit=crop&w=180&q=80',
                ],
                [
                    'name' => 'Pat W',
                    'date' => 'Wed, 29 Jan 2025 at 8:55am',
                    'rating' => 4,
                    'body' => 'Good timing, fair pricing, and the final result matched what I wanted.',
                    'avatar_initials' => 'PW',
                    'avatar_color' => '#14a38b',
                ],
            ],
        };
    }

    private function previewReviewSummary(array $reviews): array
    {
        $count = count($reviews);

        if ($count === 0) {
            return [
                'rating' => '0.0',
                'count' => '0',
            ];
        }

        $average = array_sum(array_map(static fn (array $review): int => $review['rating'], $reviews)) / $count;

        return [
            'rating' => number_format($average, 1),
            'count' => (string) $count,
        ];
    }

    private function previewAdditionalInformation(string $category): array
    {
        return match ($category) {
            'Massage therapy', 'Spa' => [
                'Instant confirmation',
                'Kid-friendly',
                'Parking available',
                'Near public transport',
                'Showers',
                'Woman-owned',
            ],
            'Fitness studio' => [
                'Instant confirmation',
                'Parking available',
                'Changing rooms',
                'Near public transport',
                'Showers',
                'Card and M-Pesa accepted',
            ],
            default => [
                'Instant confirmation',
                'Kid-friendly',
                'Parking available',
                'Near public transport',
                'Walk-ins welcome',
                'Woman-owned',
            ],
        };
    }

    private function previewWeeklyHours(string $openingTime, string $closingTime): array
    {
        $openLabel = $this->formatDisplayTime($openingTime).' - '.$this->formatDisplayTime($closingTime);

        return [
            ['day' => 'Monday', 'hours' => $openLabel, 'is_open' => true],
            ['day' => 'Tuesday', 'hours' => $openLabel, 'is_open' => true],
            ['day' => 'Wednesday', 'hours' => $openLabel, 'is_open' => true],
            ['day' => 'Thursday', 'hours' => $openLabel, 'is_open' => true],
            ['day' => 'Friday', 'hours' => $openLabel, 'is_open' => true],
            ['day' => 'Saturday', 'hours' => $openLabel, 'is_open' => true],
            ['day' => 'Sunday', 'hours' => 'Closed', 'is_open' => false],
        ];
    }

    private function previewMapData(string $city, string $neighborhood): array
    {
        $locationKey = strtolower(trim($neighborhood.' '.$city));

        $points = [
            'kilimani nairobi' => ['lat' => -1.2921, 'lng' => 36.7838],
            'westlands nairobi' => ['lat' => -1.2676, 'lng' => 36.8108],
            'karen nairobi' => ['lat' => -1.3197, 'lng' => 36.7073],
            'nyali mombasa' => ['lat' => -4.0200, 'lng' => 39.7242],
            'kisumu kisumu' => ['lat' => -0.0917, 'lng' => 34.7680],
            'nakuru nakuru' => ['lat' => -0.3031, 'lng' => 36.0800],
            'eldoret eldoret' => ['lat' => 0.5143, 'lng' => 35.2698],
        ];

        $point = $points[$locationKey] ?? null;

        if (! $point) {
            foreach ($points as $key => $candidate) {
                if (str_contains($locationKey, $key)) {
                    $point = $candidate;
                    break;
                }
            }
        }

        $point ??= ['lat' => -1.2864, 'lng' => 36.8172];

        $lat = $point['lat'];
        $lng = $point['lng'];
        $bbox = sprintf(
            '%F,%F,%F,%F',
            $lng - 0.025,
            $lat - 0.018,
            $lng + 0.025,
            $lat + 0.018
        );

        return [
            'embed_url' => 'https://www.openstreetmap.org/export/embed.html?bbox='.$bbox.'&layer=mapnik&marker='.$lat.','.$lng,
        ];
    }

    private function previewBookingDates(): array
    {
        $dates = [];

        for ($offset = 0; $offset < 5; $offset++) {
            $date = now()->addDays($offset);

            $dates[] = [
                'display' => $date->format('j M'),
                'label' => $date->format('D'),
                'value' => $date->format('Y-m-d'),
            ];
        }

        return $dates;
    }

    private function previewBookingTimeSlots(string $openingTime, string $closingTime): array
    {
        $start = strtotime($openingTime);
        $end = strtotime($closingTime);

        if ($start === false || $end === false || $start >= $end) {
            return ['9:00 am', '9:30 am', '10:00 am', '10:30 am', '11:00 am', '11:30 am'];
        }

        $slots = [];
        $maxSlots = 8;

        while ($start < $end && count($slots) < $maxSlots) {
            $slots[] = date('g:i a', $start);
            $start += 1800;
        }

        return $slots;
    }

    private function previewBookingStaff(array $teamMembers): array
    {
        return array_map(static function (array $member): array {
            $member['slug'] = Str::slug($member['name']);

            return $member;
        }, $teamMembers);
    }

    private function resolvePreviewService(array $services, ?string $serviceSlug): array
    {
        $fallback = $services[0] ?? ['name' => 'Service', 'duration' => '', 'price' => ''];

        foreach ($services as $service) {
            if (Str::slug($service['name']) === $serviceSlug) {
                $service['slug'] = Str::slug($service['name']);

                return $service;
            }
        }

        $fallback['slug'] = Str::slug($fallback['name']);

        return $fallback;
    }

    private function resolvePreviewStaff(array $staffMembers, ?string $staffSlug): array
    {
        $fallback = $staffMembers[0] ?? ['name' => 'Team member', 'role' => '', 'rating' => '5.0', 'image' => '', 'slug' => 'team-member'];

        foreach ($staffMembers as $member) {
            if (($member['slug'] ?? null) === $staffSlug) {
                return $member;
            }
        }

        return $fallback;
    }

    private function formatDisplayTime(string $time): string
    {
        $timestamp = strtotime($time);

        if ($timestamp === false) {
            return $time;
        }

        return date('g:i a', $timestamp);
    }
}
