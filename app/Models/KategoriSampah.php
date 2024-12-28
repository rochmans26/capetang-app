<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class KategoriSampah extends Model
{
    use HasFactory;

    protected $table = 'kategori_sampah';

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
        'gambar',
    ];

    public function setorSampah()
    {
        return $this->hasMany(SetorSampah::class, 'id_kategori', 'id');
    }

    /**
     *  Helper function
     */
    public function getImageUrlAttribute()
    {
        if (!$this->gambar) {
            return asset('img/sample-item-card.jpg');
        }
        return Storage::url('public/uploads/kategori/' . $this->gambar);
    }

    public static function uploadImage($file)
    {
        $fileName = time() . '.' . $file->extension();
        $file->storeAs('public/uploads/kategori', $fileName);
        return $fileName;
    }

    public static function deleteImage($fileName)
    {
        return Storage::exists('public/uploads/kategori/' . $fileName) && Storage::delete('public/uploads/kategori/' . $fileName);
    }
}
