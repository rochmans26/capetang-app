<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Quests per user
        $user = auth()->user();
        $totalQuests = $user->total_quests;
        $activeQuests = $user->active_quests;
        $completedQuests = $user->completed_quests;

        // Ambil 3 user teratas dengan total point terbanyak
        $topUser = User::with('reward')->withSum('reward', 'point_reward')
            ->orderBy('reward_sum_point_reward', 'desc')
            ->limit(3)
            ->get()
            ->map(function ($value) {
                return [
                    'name' => $value['name'],
                    'point' => $value['reward_sum_point_reward'] ?? 0,
                ];
            })->toArray();

        // Grafik Setoran Sampah Per Bulan
        $bulan = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $setorSampah = $user->setorSampah()
            ->selectRaw('MONTH(tgl_setor_sampah) as month, SUM(berat_sampah) as total')
            ->groupBy('month')
            ->get()
            ->mapWithKeys(function ($value) use ($bulan) {
                return [$bulan[$value['month'] - 1] => $value['total']];
            })->toArray();

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
}
