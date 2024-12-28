<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    public function getImageUrlAttribute()
    {
        if (!$this->bukti_penyerahan) {
            return asset('img/sample-item-card.jpg');
        }
        return Storage::url('public/uploads/penukaran-poin/' . $this->bukti_penyerahan);
    }

    public static function uploadImage($file)
    {
        $fileName = time() . '.' . $file->extension();
        $file->storeAs('public/uploads/penukaran-poin', $fileName);
        return $fileName;
    }

    public static function deleteImage($fileName)
    {
        return Storage::exists('public/uploads/penukaran-poin/' . $fileName) && Storage::delete('public/uploads/penukaran-poin/' . $fileName);
    }
}
