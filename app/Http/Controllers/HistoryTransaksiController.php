<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryTransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:lihat-riwayat-transaksi')->only(['riwayatRewardUser', 'riwayatSetorSampahUser', 'riwayatTukarPoinUser']);
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

        return view('users.riwayat_tukar_poin', compact('userHistory'));
    }
}
