<?php

namespace App\Http\Controllers;

use App\Models\SetorSampah;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:lihat-dashboard');
    }

    public function userDashboard()
    {
        // Quests per user
        $user = auth()->user();
        $totalQuests = $user->total_quests;
        $activeQuests = $user->active_quests;
        $completedQuests = $user->completed_quests;

        // Ambil 3 user teratas dengan total point terbanyak
        $topUser = User::topUsers();

        // Grafik Setoran Sampah Per Bulan
        $bulan = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $setorSampah = $user->setorSampah()->grafikSetorSampah($bulan);

        // Tambahkan data kosong untuk bulan yang tidak ada datanya
        $setorSampah = array_merge(array_fill_keys($bulan, 0), $setorSampah);

        return view('users.dashboard', [
            'topUser' => $topUser,
            'setorSampah' => $setorSampah,
            'totalQuests' => $totalQuests,
            'activeQuests' => $activeQuests,
            'completedQuests' => $completedQuests
        ]);
    }

    public function adminDashboard()
    {
        // Quests per user
        $user = auth()->user();

        // Ambil 3 user teratas dengan total point terbanyak
        $topUser = User::topUsers();

        // Grafik Setoran Sampah Per Bulan
        $bulan = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $setorSampah = $user->setorSampah()->grafikSetorSampah($bulan);

        // Tambahkan data kosong untuk bulan yang tidak ada datanya
        $setorSampah = array_merge(array_fill_keys($bulan, 0), $setorSampah);

        // Berat sampah per kategori khusus admin
        $beratPerKategori = SetorSampah::beratPerKategori();

        return view('admin.dashboard', [
            'topUser' => $topUser,
            'setorSampah' => $setorSampah,
            'beratPerKategori' => $beratPerKategori
        ]);
    }
}
