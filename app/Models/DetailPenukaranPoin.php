<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenukaranPoin extends Model
{
    use HasFactory;

    protected $table = 'pivot_transaksi_tukar_poin_item';

    protected $fillable = [
        'id_transaksi',
        'id_item',
        'jumlah_item',
    ];

    public function transaksiTukarPoin()
    {
        return $this->belongsTo(TransaksiTukarPoint::class, 'id_transaksi', 'id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item', 'id');
    }
}
