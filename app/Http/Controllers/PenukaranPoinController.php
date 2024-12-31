<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenukaranPoinRequest;
use App\Models\Item;
use App\Models\TransaksiTukarPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenukaranPoinController extends Controller
{
    public $adminAkses = [
        'tambah-item',
        'ubah-item',
        'hapus-item',
    ];

    public $userAkses = [
        'lihat-penukaran-poin',
    ];

    public function __construct()
    {
        $this->middleware('permission:lihat-penukaran-poin');
    }

    public function index()
    {
        $listItem = Item::where('stok_item', '>', 0)->get();

        return !request()->user()->canAny($this->adminAkses) ?
            view('users.tukar_poin', compact('listItem')) :
            redirect()->route('item.index');
    }

    public function viewCheckout()
    {
        return view('users.checkout');
    }

    public function directCheckout(PenukaranPoinRequest $request)
    {
        $validasi = $request->validated();
        $quantity = $validasi['jumlah_item'] ?? 1;
        $item = Item::findOrFail($request->id_item);
        $user = $request->user();

        if ($quantity > $item->stok_item) {
            return redirect()->route('users.penukaran-poin')
                ->withErrors(['jumlah_item' => 'Jumlah item melebihi stok item']);
        }

        // Kalkulasi total transaksi
        $totalTransaksi = $item->point_item * $quantity;

        // Simpan data ke sesi
        $expiryTime = now()->addMinute(5);

        session()->put('data', [
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'alamat' => $user->alamat,
            ],
            'item' => [
                'id' => $item->id,
                'nama_item' => $item->nama_item,
                'point_item' => $item->point_item,
                'image_url' => $item->image_url,
            ],
            'quantity' => $quantity,
            'total' => $totalTransaksi,
            'expires_at' => $expiryTime,
        ]);

        return redirect()->route('users.checkout')
            ->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function prosesDirectCheckout(Request $request)
    {
        $cart = session('data');
        $user = $request->user();
        $item = Item::findOrFail($cart['item']['id']);
        $quantity = $cart['quantity'];
        $total = $cart['total'];

        // Mulai transaksi
        DB::beginTransaction();
        try {
            // Buat transaksi penukaran poin
            $transaction = $user->penukaranPoin()->create([
                'tgl_transaksi' => now(),
                'total_transaksi' => $total,
                'status_transaksi' => 'success',
            ]);

            // Buat detail transaksi penukaran poin
            $transaction->detailTransaksi()->create([
                'id_item' => $item->id,
                'jumlah_item' => $quantity,
            ]);

            // Kurangi stok item
            $item->decrement('stok_item', $quantity);

            // Kurangi poin
            $transaction->pencatatanReward($transaction);

            // Commit transaksi jika semua berhasil
            DB::commit();

            // Hapus sesi data
            session()->forget('data');

            return redirect()->route('users.detail-transaksi', ['id' => $transaction->id])
                ->with('success', 'Transaksi berhasil diproses, silakan cek detail transaksi.');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Hapus sesi data dan kembalikan error
            session()->forget('data');

            return redirect()->route('users.penukaran-poin')
                ->withErrors(['error' => 'Terjadi kesalahan saat memproses transaksi. Silakan coba lagi.']);
        }
    }

    public function showDetailTransaksi($id)
    {
        $transaction = TransaksiTukarPoint::findOrFail($id);

        $transaction = TransaksiTukarPoint::with('detailTransaksi')
            ->where('id_user', auth()->user()->id)
            ->findOrFail($id);

        return view('users.detail_transaksi_tukar_poin', compact('transaction'));
    }

    public function viewCart(Request $request)
    {
        $transaksi = TransaksiTukarPoint::with('item')
            ->where('id_user', $request->user()->id)
            ->where('status_transaksi', 'cart')
            ->get();

        if (!$transaksi) {
            return redirect()->route('users.penukaran-poin')
                ->withErrors(['error' => 'Keranjang kosong, silakan tambahkan item terlebih dahulu.']);
        }

        return response()->json(['cart' => $transaksi]);
    }

    public function addToCart(PenukaranPoinRequest $request)
    {
        $user = $request->user();

        // Cari atau buat transaksi dengan status cart
        $transaksi = TransaksiTukarPoint::firstOrCreate(
            [
                'id_user' => $user->id,
                'status_transaksi' => 'cart',
            ],
            [
                'tgl_transaksi' => now(),
                'total_transaksi' => 0,
            ]
        );

        $item = Item::findOrFail($request->id_item);

        if ($request->jumlah_item > $item->stok_item) {
            return redirect()->route('users.penukaran-poin')
                ->withErrors(['jumlah_item' => 'Jumlah item melebihi stok item']);
        }

        // Tambahkan atau update jumlah item
        $transaksi->item()->syncWithoutDetaching([
            $item->id => [
                'jumlah_item' => ($transaksi->item()->where('id_item', $item->id)->exists()
                    ? $transaksi->item()->where('id_item', $item->id)->first()->pivot->jumlah_item + $request->jumlah_item
                    : $request->jumlah_item),
            ]
        ]);

        // Update total transaksi
        $transaksi->total_transaksi = $transaksi->item->sum(function ($item) {
            return $item->pivot->jumlah_item * $item->point_item;
        });

        $transaksi->save();

        return redirect()->route('users.penukaran-poin')
            ->with('success', 'Item berhasil ditambahkan ke keranjang');
    }

    public function removeFromCart(Request $request, $itemId)
    {
        $user = $request->user();

        // Cari transaksi dengan status cart
        $transaksi = TransaksiTukarPoint::with('item')->where('id_user', $user->id)->where('status_transaksi', 'cart')->first();

        if (!$transaksi) {
            return redirect()->route('users.penukaran-poin')
                ->withErrors(['error' => 'Keranjang tidak ditemukan.']);
        }

        // Cari item di dalam transaksi
        $item = $transaksi->item()->where('id_item', $itemId)->first();

        if (!$item) {
            return redirect()->route('users.penukaran-poin')
                ->withErrors(['error' => 'Item tidak ditemukan di keranjang.']);
        }

        // Hapus item dari keranjang
        $transaksi->item()->detach($itemId);

        // Perbarui total transaksi
        $transaksi->total_transaksi = $transaksi->item->sum(function ($item) {
            return $item->pivot->jumlah_item * $item->point_item;
        });

        // Jika keranjang kosong, hapus transaksi
        if ($transaksi->item->isEmpty()) {
            $transaksi->delete();

            return redirect()->route('users.penukaran-poin')
                ->with('success', 'Keranjang kosong silahkan tambahkan item terlebih dahulu.');
        }

        // Simpan perubahan transaksi
        $transaksi->save();

        return redirect()->route('users.penukaran-poin')
            ->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    public function checkoutCart(Request $request)
    {
        $user = $request->user();

        // Ambil transaksi dengan status cart
        $transaksi = TransaksiTukarPoint::with('item')->where('id_user', $user->id)->where('status_transaksi', 'cart')->first();

        if (!$transaksi) {
            return redirect()->route('users.penukaran-poin')
                ->withErrors(['error' => 'Keranjang kosong. Tidak ada transaksi untuk diproses.']);
        }

        DB::beginTransaction();

        try {
            // Loop melalui item untuk mengurangi stok
            foreach ($transaksi->item as $item) {
                if ($item->pivot->jumlah_item > $item->stok_item) {
                    throw new \Exception('Stok untuk item ' . $item->nama_item . ' tidak mencukupi.');
                }

                // Kurangi stok item
                $item->decrement('stok_item', $item->pivot->jumlah_item);
            }

            // Perbarui status transaksi menjadi 'success'
            $transaksi->update(['status_transaksi' => 'success']);

            // Commit transaksi database
            DB::commit();

            return redirect()->route('users.penukaran-poin')
                ->with('success', 'Checkout berhasil! Transaksi telah selesai diproses.');
        } catch (\Exception $e) {
            // Rollback transaksi database jika terjadi kesalahan
            DB::rollBack();

            return redirect()->route('users.penukaran-poin')
                ->withErrors(['error' => 'Gagal melakukan checkout: ' . $e->getMessage()]);
        }
    }
}
