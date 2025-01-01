<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Item extends Model
{
    use HasFactory;

    protected $table = 'item';

    protected $fillable = [
        'nama_item',
        'stok_item',
        'deskripsi_item',
        'point_item',
        'foto_item',
    ];

    public $appends = ['image_url'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'pivot_transaksi_tukar_poin_item', 'id_item', 'id_user')->withPivot('jumlah_item');
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetailPenukaranPoin::class, 'id_item', 'id');
    }

    /**
     *  Helper function
     */
    public function getImageUrlAttribute()
    {
        if (!$this->foto_item) {
            return asset('img/sample-item-card.jpg');
        }
        return Storage::url('public/uploads/item/' . $this->foto_item);
    }

    public static function uploadImage($file)
    {
        $fileName = time() . '.' . $file->extension();
        $file->storeAs('public/uploads/item', $fileName);
        return $fileName;
    }

    public static function deleteImage($fileName)
    {
        return Storage::exists('public/uploads/item/' . $fileName) && Storage::delete('public/uploads/item/' . $fileName);
    }
}
