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
        $user = auth()->user();
        // Ambil riwayat reward poin dan urutkan berdasarkan data terbaru
        $userHistory = $user->reward()
            ->diselesaikan()
            ->latest()
            ->get();

        return view('users.riwayat_reward_poin', compact('userHistory'));
    }

    public function riwayatSetorSampahUser()
    {
        $user = auth()->user();
        // Ambil riwayat setoran sampah dan urutkan berdasarkan data terbaru
        $userHistory = $user->setorSampah()->latest('tgl_setor_sampah')->get();

        return view('users.riwayat_setor_sampah', compact('userHistory'));
    }

    public function riwayatTukarPoinUser()
    {
        $user = auth()->user();
        // Ambil riwayat tukar poin dan urutkan berdasarkan data terbaru
        $userHistory = $user->penukaranPoin()->with('item')->latest('created_at')->get();

        // dd($userHistory->toArray());

        return view('users.riwayat_tukar_poin', compact('userHistory'));
    }
}
