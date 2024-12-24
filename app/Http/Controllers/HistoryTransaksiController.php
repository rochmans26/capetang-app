<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryTransaksiController extends Controller
{
    public function riwayatRewardUser()
    {
        $user = auth()->user();
        // Ambil riwayat reward poin dan urutkan berdasarkan data terbaru
        $userHistory = $user->reward()->latest()->get();

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
        return view('users.riwayat_tukar_poin');
    }
}
