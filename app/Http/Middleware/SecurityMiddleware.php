<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use App\Models\ActivityLog;

class SecurityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Rate limiting untuk API endpoints
        if ($request->is('api/*') || $request->is('auth/*')) {
            $key = 'api_requests:' . $request->ip();

            if (RateLimiter::tooManyAttempts($key, 100)) { // 100 requests per minute
                $seconds = RateLimiter::availableIn($key);

                // Log suspicious activity
                ActivityLog::create([
                    'user_type' => 'system',
                    'user_id' => 0,
                    'action' => 'rate_limit_exceeded',
                    'description' => "Rate limit exceeded for IP: {$request->ip()}",
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'metadata' => [
                        'endpoint' => $request->path(),
                        'method' => $request->method(),
                        'seconds_remaining' => $seconds
                    ]
                ]);

                return response()->json([
                    'success' => false,
                    'message' => "Terlalu banyak permintaan. Coba lagi dalam {$seconds} detik.",
                    'retry_after' => $seconds
                ], 429);
            }

            RateLimiter::hit($key, 60);
        }

        // Security headers
        $response = $next($request);

        // Add security headers
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');

        // CSP Header untuk mencegah XSS
        $csp = "default-src 'self'; " .
            "script-src 'self' 'unsafe-inline' 'unsafe-eval'; " .
            "style-src 'self' 'unsafe-inline'; " .
            "img-src 'self' data: https:; " .
            "font-src 'self' data:; " .
            "connect-src 'self' ws: wss:; " .
            "media-src 'self' blob:; " .
            "object-src 'none'; " .
            "base-uri 'self'; " .
            "form-action 'self';";

        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}
