<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    public function handle(Request $request, Closure $next): Response
    {
        // If the user is not logged in OR if their role is not 'admin'
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            // Send them back to the home page
            return redirect('/');
        }

        // Otherwise, allow them to proceed to the admin page
        return $next($request);
    }
}