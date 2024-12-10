<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
