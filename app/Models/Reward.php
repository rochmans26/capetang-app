<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;

    protected $table = 'reward';

    protected $fillable = [
        'nama_reward',
        'id_user',
        'id_transaksi',
        'tipe_transaksi',
        'point_reward',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function setorSampah()
    {
        return $this->morphOne(SetorSampah::class, 'rewardable');
    }

    public function userQuest()
    {
        return $this->morphOne(UserQuest::class, 'rewardable');
    }

    /*
    *  Helper function untuk mengkonversi tipe transaksi
    */
    public function getTipeTransaksiAttribute($value)
    {
        switch ($value) {
            case 'App\Models\SetorSampah':
                return 'Setor Sampah';
            default:
                return 'Quest';
        }
    }
}
