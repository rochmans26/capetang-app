<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserQuestRequest;
use App\Models\Quest;
use App\Models\User;
use App\Models\UserQuest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GamifikasiController extends Controller
{
    public function index(Request $request)
    {
        $questTersedia = Quest::aktif()->get();
        $questKadaluarsa = Quest::kadaluarsa()->get();

        return view('admin.transaksi.quest.index', compact('questTersedia', 'questKadaluarsa'));
    }

    public function ambilQuest(string $id)
    {
        $user = auth()->user();

        $quest = Quest::find($id);

        // Periksa apakah quest tidak ditemukan atau tidak aktif
        if (!$quest || !$quest->berlangsung()) {
            return redirect()->back()->with('error', 'Quest tidak aktif atau tidak ditemukan');
        }

        // Periksa apakah pengguna sudah pernah mengambil quest ini
        if ($quest->sudahDiambil($user->id)) {
            return redirect()->back()->with('error', 'Anda sudah pernah mengambil quest ini');
        }

        // Tambahkan pengguna ke quest dengan status 'ditugaskan'
        $quest->users()->attach($user->id, [
            'status' => 'ditugaskan',
            'created_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Quest berhasil diambil');
    }

    public function detailQuest(string $id)
    {
        $quest = Quest::with('users')->findOrFail($id);
        $user = $quest->users->firstOrFail();
        $quest->status = $user->pivot->getAttribute('status');
        $quest->bukti_penyerahan = $user->pivot->getAttribute('bukti_penyerahan') ?? "Belum upload bukti penyerahan";

        return view('admin.transaksi.quest.show', compact('quest'));
    }

    public function editQuest(string $id)
    {
        $quest = Quest::findOrFail($id);
        return view('admin.transaksi.quest.edit', compact('quest'));
    }

    public function updateQuest(string $id, UserQuestRequest $request)
    {
        $user = auth()->user();
        $quest = Quest::findOrFail($id);
        $userQuest = $quest->users()->where('id_user', $user->id)->first();

        // Periksa apakah pengguna mengambil quest saat ini
        if (!$userQuest) {
            return redirect()->route('list-quest')->with('error', 'Anda belum mengambil quest ini');
        }

        $pivot = $userQuest->pivot;

        // proses upload bukti penyerahan
        if ($request->hasFile('bukti_penyerahan')) {
            DB::transaction(function () use ($pivot, $request) {
                UserQuest::deleteBuktiPenyerahan($pivot->bukti_penyerahan);
                $buktiPenyerahan = UserQuest::uploadBuktiPenyerahan($request->file('bukti_penyerahan'));

                // Perbarui status dan bukti penyerahan di pivot table
                $pivot->update([
                    'status' => 'menunggu',
                    'bukti_penyerahan' => $buktiPenyerahan,
                ]);
            });

            return redirect()->route('detail-quest', $pivot->id_quest)->with('success', 'Bukti penyerahan berhasil diupload');
        }

        return redirect()->route('detail-quest', $id)->with('success', 'Quest berhasil diperbarui');
    }

    public function hapusQuest(string $id)
    {
        $user = auth()->user();
        $quest = Quest::findOrFail($id);

        // Periksa apakah pengguna mengambil quest saat ini
        if ($quest->sudahDiambil($user->id)) {
            // Hapus pengguna dari quest
            $quest->users()->detach($user->id);
            // Hapus bukti penyerahan jika ada
            UserQuest::deleteBuktiPenyerahan($quest->users()->where('id_user', $user->id)->first()->pivot->bukti_penyerahan);

            return redirect()->route('list-quest')->with('success', 'Quest berhasil dihapus');
        }

        return redirect()->route('list-quest')->with('error', 'Anda belum mengambil quest ini');
    }

    /*
    * Admin Reward Quest
    */
    public function penerimaReward(Request $request)
    {
        $usersQuest = User::with(['quest' => function ($query) {
            $query->wherePivot('status', 'menunggu');
        }])->get();

        return view('admin.transaksi.quest.admin', compact('usersQuest'));
    }

    public function updateStatus($userId, $questId)
    {
        // Cari relasi UserQuest berdasarkan userId dan questId
        $userQuest = UserQuest::with('quest')->where('id_user', $userId)
            ->where('id_quest', $questId)
            ->firstOrFail();

        // Update status menjadi 'selesai'
        $userQuest->update(['status' => 'selesai']);

        // Kirim reward ke pengguna
        $userQuest->pencatatanReward($userQuest);

        return redirect()->route('reward-quest')->with('success', 'Reward berhasil dikirim');
    }
}
