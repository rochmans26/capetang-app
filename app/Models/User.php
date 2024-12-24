<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_role',
        'name',
        'email',
        'password',
        'status',
        'wilayah_bank_unit',
        'foto',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['points'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id');
    }

    public function setorSampah()
    {
        return $this->hasMany(SetorSampah::class, 'id_user', 'id');
    }

    public function quest()
    {
        return $this->belongsToMany(Quest::class, 'pivot_user_quest', 'id_user', 'id_quest')->withPivot('status', 'bukti_penyerahan');
    }

    public function userQuest()
    {
        return $this->hasMany(UserQuest::class, 'id_user', 'id');
    }

    public function reward()
    {
        return $this->hasMany(Reward::class, 'id_user', 'id');
    }

    public function transaksiTukarPoint()
    {
        return $this->hasMany(TransaksiTukarPoint::class, 'id_user', 'id');
    }

    /*
    *   Helper function
    */
    public function getPointsAttribute()
    {
        return $this->reward()->sum('point_reward');
    }

    public function getActiveQuestsAttribute()
    {
        return $this->quest()
            ->where('status', '!=', 'selesai')
            ->where('waktu_mulai', '<=', now())
            ->where('waktu_berakhir', '>=', now())
            ->count();
    }

    public function getCompletedQuestsAttribute()
    {
        return $this->quest()->where('status', 'selesai')->count();
    }

    public function getTotalQuestsAttribute()
    {
        return $this->quest()->count();
    }

    public function getImageUrlAttribute()
    {
        if (!$this->foto) {
            return asset('img/lb-user-1.png');
        }
        return Storage::url('public/uploads/users/' . $this->foto);
    }

    public static function uploadFoto($file)
    {
        $fileName = time() . '.' . $file->extension();
        $file->storeAs('public/uploads/users', $fileName);
        return $fileName;
    }

    public static function deleteFoto($fileName)
    {
        return Storage::exists('public/uploads/users/' . $fileName) && Storage::delete('public/uploads/users/' . $fileName);
    }
}
