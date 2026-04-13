<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Mengecek apakah user login dan apakah rolenya admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Jika bukan admin, diarahkan ke home dengan pesan peringatan
        return redirect('/')->with('error', 'Maaf, hanya Admin yang boleh mengakses halaman tersebut.');
    }
}