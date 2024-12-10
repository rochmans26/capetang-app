<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class UserQuest extends Model
{
    use HasFactory;

    protected $table = 'pivot_user_quest';

    protected $fillable = [
        'id_user',
        'id_quest',
        'bukti_penyerahan',
        'status',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function quest()
    {
        return $this->belongsTo(Quest::class, 'id_quest', 'id');
    }

    public function reward()
    {
        return $this->morphMany(Reward::class, 'rewardable');
    }

    /**
     *  Helper function
     */
    public function getImageUrlAttribute()
    {
        return Storage::url('public/uploads/quest/' . $this->bukti_penyerahan);
    }

    public static function uploadBuktiPenyerahan($file)
    {
        $fileName = time() . '.' . $file->extension();
        $file->storeAs('public/uploads/quest', $fileName);
        return $fileName;
    }

    public static function deleteBuktiPenyerahan($fileName)
    {
        return Storage::exists('public/uploads/quest/' . $fileName) && Storage::delete('public/uploads/quest/' . $fileName);
    }

    public function pencatatanReward($userQuest)
    {
        Reward::create([
            'nama_reward' => 'Reward Quest ' . $userQuest->quest->nama_quest,
            'id_user' => $userQuest->id_user,
            'id_transaksi' => $userQuest->id_quest,
            'tipe_transaksi' => $userQuest->quest->getMorphClass(),
            'point_reward' => $userQuest->quest->point,
        ]);
    }

    public function updatePencatatanReward($setorSampah)
    {
        Reward::where('id_transaksi', $setorSampah->id)
            ->update([
                'id_user' => $setorSampah->id_user,
                'point_reward' => $setorSampah->point,
            ]);
    }
}
