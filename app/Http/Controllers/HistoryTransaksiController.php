<?php

namespace App\Http\Controllers;

use App\Models\TransaksiTukarPoint;
use Illuminate\Http\Request;

class HistoryTransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:lihat-riwayat-transaksi');
    }

    public function riwayatRewardUser()
    {
        $user = request()->user();
        // Ambil riwayat reward poin dan urutkan berdasarkan data terbaru
        $userHistory = $user->reward()
            ->diselesaikan()
            ->latest()
            ->get();

        return view('users.riwayat_reward_poin', compact('userHistory'));
    }

    public function riwayatSetorSampahUser()
    {
        $user = request()->user();
        // Ambil riwayat setoran sampah dan urutkan berdasarkan data terbaru
        $userHistory = $user->setorSampah()->whereNotNull('bukti_penyerahan')->latest('tgl_setor_sampah')->get();

        // jika ingin menampilkan riwayat setoran sampah beserta yang belum diselesaikan
        // $userHistory = $user->setorSampah()->latest('tgl_setor_sampah')->get();

        return view('users.riwayat_setor_sampah', compact('userHistory'));
    }

    public function riwayatTukarPoinUser()
    {
        $user = request()->user();
        // Ambil riwayat tukar poin dan urutkan berdasarkan data terbaru
        $userHistory = $user->penukaranPoin()->with('item')->where('status_transaksi', 'success')->latest('created_at')->get();

        return !$user->hasRole('admin') ?
            view('users.riwayat_tukar_poin', compact('userHistory')) :
            redirect()->route('admin.riwayat-tukar-poin');
    }

    /*
    * Halaman riwayat tukar poin untuk role admin
    */
    public function riwayatTukarPoinAdmin()
    {
        $user = request()->user();
        $userHistory = TransaksiTukarPoint::with('item', 'detailTransaksi')
            ->where('status_transaksi', 'success')
            ->get();

        return $user->hasRole('admin') ?
            view('admin.riwayat_tukar_poin', compact('userHistory')) :
            redirect()->route('users.riwayat-tukar-poin');
    }
}
