<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiTukarPoint extends Model
{
    use HasFactory;

    protected $table = 'transaksi_tukar_poin';

    protected $fillable = [
        'id_user',
        'tgl_transaksi',
        'total_transaksi',
        'status_transaksi',
        'bukti_penyerahan',
    ];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'pivot_transaksi_tukar_poin_item', 'id_transaksi', 'id_item')->withPivot('jumlah_item');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
