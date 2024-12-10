<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
    public function hitungPoint()
    {
        return $this->reward()->sum('point_reward');
    }
}
