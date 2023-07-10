<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyParty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (
            isset($request->session()->get('party')->rsvp_code) &&
            isset($request->route('party')->rsvp_code) &&
            $request->session()->get('party')->rsvp_code === $request->route('party')->rsvp_code
        ) {
            return $next($request);
        }

        abort(403, 'You must have a RSVP code to view this page.');
    }
}
