<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Quest extends Model
{
    use HasFactory;

    protected $table = 'quest';

    protected $fillable = [
        'nama_quest',
        'deskripsi',
        'waktu_mulai',
        'waktu_berakhir',
        'point',
        'gambar',
    ];

    protected $dates = [
        'waktu_mulai',
        'waktu_berakhir',
    ];

    public function setDateFormat($format)
    {
        $this->dateFormat = 'd-m-Y H:i:s';
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'pivot_user_quest', 'id_quest', 'id_user')->withPivot('status', 'bukti_penyerahan');
    }

    public function userQuest()
    {
        return $this->hasMany(UserQuest::class, 'id_quest', 'id');
    }

    /*
    * Helper and Scopes
    */
    public function scopeAktif($query)
    {
        return $query->where('waktu_mulai', '<=', now())
            ->where('waktu_berakhir', '>=', now());
    }

    public function scopeKadaluarsa($query)
    {
        return $query->where('waktu_berakhir', '<=', now());
    }

    public function berakhir()
    {
        return $this->waktu_berakhir <= now();
    }

    public function berlangsung()
    {
        return $this->waktu_mulai <= now()
            && $this->waktu_berakhir >= now();
    }

    public function sudahDiambil($userId)
    {
        return $this->users()->where('id_user', $userId)->exists();
    }

    public function getStatusAttribute()
    {
        return $this->berlangsung() ? 'Berlangsung' : 'Kadaluarsa';
    }

    public function getImageUrlAttribute()
    {
        if (!$this->gambar) {
            return asset('img/sample-item-card.jpg');
        }
        return Storage::url('public/uploads/quest/' . $this->gambar);
    }

    public static function uploadImage($file)
    {
        $fileName = time() . '.' . $file->extension();
        $file->storeAs('public/uploads/quest', $fileName);
        return $fileName;
    }

    public static function deleteImage($fileName)
    {
        return Storage::exists('public/uploads/quest/' . $fileName) && Storage::delete('public/uploads/quest/' . $fileName);
    }
}
