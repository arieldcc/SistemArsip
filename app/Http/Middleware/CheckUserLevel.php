<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (in_array($request->user()->role, $roles)) {
            return $next($request);
        }

        // Kirim pesan error jika akses ditolak
        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini');
    }
}
