<?php

namespace App\Http\Middleware;

use App\Support\BusinessConsolePermissions;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureBusinessPosCapability
{
    public function handle(Request $request, Closure $next, string $capability): Response
    {
        $email = $request->session()->get('business_signup_email');

        if (! $email) {
            return redirect()->route('for-business.sign-in');
        }

        $role = BusinessConsolePermissions::roleForEmail($email);

        if (BusinessConsolePermissions::allows($role, $capability)) {
            return $next($request);
        }

        $redirect = $capability === 'pos.view'
            ? redirect()->route('for-business.tools')
            : redirect()->route('for-business.pos', ['tab' => BusinessConsolePermissions::tabForCapability($capability)]);

        return $redirect->with('pos_error', BusinessConsolePermissions::denialMessage($role, $capability));
    }
}
