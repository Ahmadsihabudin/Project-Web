<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        \Log::info('CustomAuth middleware:', [
            'path' => $request->path(),
            'method' => $request->method(),
            'has_user_id' => session()->has('user_id'),
            'has_user_type' => session()->has('user_type'),
            'user_id' => session('user_id'),
            'user_type' => session('user_type'),
            'session_id' => session()->getId(),
            'all_session' => session()->all()
        ]);
        
        // Check if user is logged in via session
        if (session()->has('user_id') && session()->has('user_type')) {
            return $next($request);
        }

        // Redirect to login page if not authenticated
        return redirect('/')->with('error', 'Silakan login terlebih dahulu.');
    }
}
