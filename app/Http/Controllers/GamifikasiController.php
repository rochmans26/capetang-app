<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserQuestRequest;
use App\Models\Quest;
use App\Models\UserQuest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GamifikasiController extends Controller
{
    public $adminAksesQuest = [
        'kirimkan-reward',
    ];

    public function __construct()
    {
        $this->middleware('permission:lihat-quest')->only(['allQuest', 'listQuestUser', 'detailQuest', 'infoQuest']);
        $this->middleware('permission:ambil-quest')->only(['ambilQuest']);
        $this->middleware('permission:perbarui-quest')->only(['editQuest', 'updateQuest']);
        $this->middleware('permission:batalkan-quest')->only(['hapusQuest']);
        $this->middleware('permission:kirimkan-reward')->only(['penerimaReward', 'updateStatus']);
    }

    public function allQuest()
    {
        $semuaQuest = Quest::all();

        return !request()->user()->canAny($this->adminAksesQuest) ?
            view('users.all_quest', compact('semuaQuest')) :
            redirect()->route('quest.index');
    }

    public function listQuestUser()
    {
        $user = request()->user();
        $questTersedia = $user->quest()->aktif()->where('status', '!=', 'selesai')->get();
        $questKadaluarsa = $user->quest()->kadaluarsa()->get();
        $questDiSelesaikan = $user->quest()->where('status', 'selesai')->get();

        return !$user->canAny($this->adminAksesQuest) ?
            view('users.user_quest', compact('questTersedia', 'questKadaluarsa', 'questDiSelesaikan')) :
            redirect()->route('quest.index');
    }

    public function ambilQuest(string $id)
    {
        $user = request()->user();

        $quest = Quest::findOrFail($id);

        // Periksa apakah quest tidak ditemukan atau tidak aktif
        if (!$quest || !$quest->berlangsung()) {
            return redirect()->back()
                ->withErrors([
                    'quest' => 'Quest tidak ditemukan atau tidak aktif',
                ]);
        }

        // Periksa apakah pengguna sudah pernah mengambil quest ini
        if ($quest->sudahDiambil($user->id)) {
            return redirect()->back()->withErrors([
                'quest' => 'Anda sudah pernah mengambil quest ini',
            ]);
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
        $user = request()->user();
        $quest = $user->quest()->whereHas('users', function ($query) use ($user, $id) {
            $query->where('id_user', $user->id)->where('id_quest', $id);
        })->firstOrFail();
        $quest->bukti_penyerahan = $quest->pivot->bukti_penyerahan ?? "Belum upload bukti penyerahan";
        $quest->point = $quest->getRewardPoint($user->id);

        return view('admin.transaksi.quest.show', compact('quest'));
    }

    public function infoQuest(string $id)
    {
        $quest = Quest::findOrFail($id);

        return request()->user()->canAny($this->adminAksesQuest) ?
            redirect()->route('quest.show', $id) :
            view('admin.quest.show', compact('quest'));
    }

    public function editQuest(string $id)
    {
        $quest = Quest::findOrFail($id);
        return view('admin.transaksi.quest.edit', compact('quest'));
    }

    public function updateQuest(string $id, UserQuestRequest $request)
    {
        $user = request()->user();
        $quest = Quest::findOrFail($id);
        $userQuest = $quest->users()->where('id_user', $user->id)->firstOrFail();

        // Periksa apakah pengguna mengambil quest saat ini
        if (!$userQuest) {
            return redirect()->route('users.quest-user')
                ->with('error', 'Anda belum mengambil quest ini');
        }

        $pivot = $userQuest->pivot;

        // proses upload bukti penyerahan
        if ($request->hasFile('bukti_penyerahan')) {
            DB::transaction(function () use ($pivot, $request) {
                UserQuest::deleteImage($pivot->bukti_penyerahan ?? null);
                $buktiPenyerahan = UserQuest::uploadImage($request->file('bukti_penyerahan'));

                // Perbarui status dan bukti penyerahan di pivot table
                $pivot->update([
                    'status' => 'menunggu',
                    'bukti_penyerahan' => $buktiPenyerahan,
                ]);
            });

            return redirect()->route('users.detail-quest', $pivot->id_quest)
                ->with('success', 'Bukti penyerahan berhasil diupload');
        }

        return redirect()->route('users.detail-quest', $id)
            ->with('success', 'Quest berhasil diperbarui');
    }

    public function hapusQuest(string $id)
    {
        $user = request()->user();
        $quest = Quest::findOrFail($id);

        // Periksa apakah pengguna mengambil quest saat ini
        if ($quest->sudahDiambil($user->id)) {
            // Hapus bukti penyerahan jika ada
            UserQuest::deleteImage($quest->users()->where('id_user', $user->id)->first()->pivot->bukti_penyerahan ?? null);
            // Hapus pengguna dari quest
            $quest->users()->detach($user->id);

            return redirect()->route('users.quest-user')->with('success', 'Quest berhasil dihapus');
        }

        return redirect()->route('users.quest-user')->with('error', 'Anda belum mengambil quest ini');
    }

    /*
    * Admin Reward Quest
    */
    public function penerimaReward(Request $request)
    {
        // $usersQuest = User::with(['quest' => function ($query) {
        //     $query->wherePivot('status', 'menunggu');
        // }])->get();

        $usersQuest = DB::table('pivot_user_quest')
            ->join('users', 'pivot_user_quest.id_user', '=', 'users.id')
            ->join('quest', 'pivot_user_quest.id_quest', '=', 'quest.id')
            ->where('pivot_user_quest.status', 'menunggu')
            ->select('pivot_user_quest.*', 'users.name as user_name', 'quest.nama_quest as quest_name')
            ->paginate(10);

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

        return redirect()->route('admin.reward-quest')->with('success', 'Reward berhasil dikirim');
    }
}
