<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetorSampah extends Model
{
    use HasFactory;

    protected $table = 'setor_sampah';

    protected $fillable = [
        'tgl_setor_sampah',
        'id_user',
        'id_kategori',
        'berat_sampah',
        'bukti_penyerahan',
        'point',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriSampah::class, 'id_kategori', 'id');
    }

    public function reward()
    {
        return $this->morphMany(Reward::class, 'rewardable');
    }

    /*
     * Helper untuk menghitung point berdasarkan berat sampah
     */
    public static function hitungPoint($beratSampah)
    {
        return floor($beratSampah / 100);
    }

    public function pencatatanReward($setorSampah)
    {
        Reward::create([
            'nama_reward' => 'Setor Sampah',
            'id_user' => $setorSampah->id_user,
            'id_transaksi' => $setorSampah->id,
            'tipe_transaksi' => $setorSampah->getMorphClass(),
            'point_reward' => $setorSampah->point,
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

    public function deletePencatatanReward($setorSampah)
    {
        Reward::where('id_transaksi', $setorSampah->id)->delete();
    }
}
