<?php

namespace App\Http\Middleware;

use App\Models\Item;
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

        // Cek apakah data kosong
        if (!$data) {
            return $this->redirectToPenukaranPoin('Keranjang kosong, silakan tambahkan item terlebih dahulu.');
        }

        // Cek apakah sesi kedaluwarsa
        if ($data && now()->greaterThan($data['expires_at'])) {
            session()->forget('data');
            return $this->redirectToPenukaranPoin('Waktu checkout telah habis, silakan coba lagi.');
        }

        $item = Item::findOrFail($data['item']['id']);

        // Cek apakah item kosong
        if (!$item) {
            session()->forget('data');
            return $this->redirectToPenukaranPoin('Item tidak ditemukan. Silakan coba lagi.');
        }

        // Cek apakah point item sama dengan yang ada di item
        if ($data['item']['point_item'] !== $item->point_item) {
            session()->forget('data');
            return $this->redirectToPenukaranPoin('Point item tidak sesuai. Silakan coba lagi.');
        }

        // Cek apakah stok item kurang dari jumlah item
        if ($item->stok_item < $data['quantity']) {
            session()->forget('data');
            return $this->redirectToPenukaranPoin('Stok item tidak mencukupi.');
        }

        // Cek apakah points users kurang dari total transaksi
        if ($request->user()->points < $data['total']) {
            return redirect()->route('users.view-checkout')
                ->withErrors(['error' => 'Poin Anda tidak mencukupi untuk melakukan transaksi.']);
        }

        return $next($request);
    }

    private function redirectToPenukaranPoin(string $message): Response
    {
        return redirect()->route('users.penukaran-poin')
            ->withErrors(['error' => $message]);
    }
}
