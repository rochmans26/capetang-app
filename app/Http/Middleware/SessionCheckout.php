<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SessionCheckout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $data = session('data');

        // Cek apakah sesi kedaluwarsa
        if ($data && now()->greaterThan($data['expires_at'])) {
            session()->forget('data');
            return redirect()->route('users.penukaran-poin')
                ->withErrors(['error' => 'Waktu checkout telah habis, silakan coba lagi.']);
        }

        // Cek apakah data kosong
        if (!$data) {
            return redirect()->route('users.penukaran-poin')
                ->withErrors(['error' => 'Keranjang kosong, silakan tambahkan item terlebih dahulu.']);
        }

        return $next($request);
    }
}
