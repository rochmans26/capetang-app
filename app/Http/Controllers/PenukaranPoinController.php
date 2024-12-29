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

    public function create()
    {
        return view('users.checkout');
    }

    public function cartUser()
    {
        return response()->json([
            "test" => "test"
        ]);
    }

    public function store(PenukaranPoinRequest $request)
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
            ],
            'quantity' => $quantity,
            'total' => $totalTransaksi,
            'expires_at' => $expiryTime,
        ]);

        return redirect()->route('users.checkout')
            ->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function prosesCheckout(Request $request)
    {
        $cart = session('data');
        $user = $request->user();
        $item = Item::findOrFail($cart['item']['id']);
        $quantity = $cart['quantity'];
        $total = $cart['total'];

        // Validasi awal untuk poin dan stok
        if ($user->points < $total) {
            session()->forget('data');

            return redirect()->route('users.penukaran-poin')
                ->withErrors(['error' => 'Poin tidak mencukupi.']);
        }

        if ($item->stok_item < $quantity) {
            session()->forget('data');

            return redirect()->route('users.penukaran-poin')
                ->withErrors(['error' => 'Stok item tidak mencukupi.']);
        }

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

            return view('users.detail_transaksi_tukar_poin', compact('cart'));
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Hapus sesi data dan kembalikan error
            session()->forget('data');

            return redirect()->route('users.penukaran-poin')
                ->withErrors(['error' => 'Terjadi kesalahan saat memproses transaksi. Silakan coba lagi.']);
        }
    }

    public function show($id)
    {
        $transaction = TransaksiTukarPoint::with('item', 'user')->findOrFail($id);

        return view('users.detail_transaksi_tukar_poin', compact('transaction'));
    }
}
