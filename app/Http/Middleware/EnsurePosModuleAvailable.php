<?php

namespace App\Http\Middleware;

use App\Support\BusinessConsoleSchema;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePosModuleAvailable
{
    public function handle(Request $request, Closure $next): Response
    {
        if (BusinessConsoleSchema::hasPosModuleTables()) {
            return $next($request);
        }

        return redirect()
            ->route('for-business.tools')
            ->with('dashboard_warning', 'The POS module database migration has not been applied on this environment yet. Run `php artisan migrate` to enable POS features.');
    }
}
