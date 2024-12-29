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
        return $this->belongsTo(SetorSampah::class, 'id_transaksi', 'id');
    }

    public function userQuest()
    {
        return $this->belongsTo(UserQuest::class, 'id_transaksi', 'id_quest');
    }

    public function transaksiTukarPoin()
    {
        return $this->belongsTo(TransaksiTukarPoint::class, 'id_transaksi', 'id');
    }

    /*
    *  Helper function untuk mengkonversi tipe transaksi
    */
    public function getTipeTransaksiAttribute($value)
    {
        switch ($value) {
            case 'App\Models\SetorSampah':
                return 'Setor Sampah';
            case 'App\Models\Quest':
                return 'Quest';
            case 'App\Models\TransaksiTukarPoint':
                return 'Tukar Poin';
            default:
                return null;
        }
    }

    /*
    *  Scopes untuk filter data reward berdasarkan
    *  setor sampah dan user quest
    *  yang telah diselesaikan
    */
    public function scopeDiselesaikan($query)
    {
        return $query->where(function ($q) {
            $q->whereHas('setorSampah', function ($query) {
                $query->whereNotNull('bukti_penyerahan');
            })
                ->orWhereHas('userQuest', function ($query) {
                    $query->where('status', 'selesai');
                })
                ->orWhereHas('transaksiTukarPoin', function ($query) {
                    $query->where('status_transaksi', 'success');
                });
        });
    }
}
