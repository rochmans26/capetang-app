<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'rt',
        'rw',
        'alamat',
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

    public function transaksiTukarPoin()
    {
        return $this->belongsToMany(TransaksiTukarPoint::class, 'pivot_transaksi_tukar_poin_item', 'id_user', 'id_item')->withPivot('jumlah_item');
    }

    public function penukaranPoin()
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

    public static function uploadImage($file)
    {
        $fileName = time() . '.' . $file->extension();
        $file->storeAs('public/uploads/users', $fileName);
        return $fileName;
    }

    public static function deleteImage($fileName)
    {
        return Storage::exists('public/uploads/users/' . $fileName) && Storage::delete('public/uploads/users/' . $fileName);
    }

    public function scopeTopUsers($query)
    {
        return $query->whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })
            ->withSum('reward', 'point_reward')
            ->orderBy('reward_sum_point_reward', 'desc')
            ->limit(3)
            ->get()
            ->map(function ($user) {
                return [
                    'name' => $user->name,
                    'point' => $user->reward_sum_point_reward ?? 0,
                ];
            })->toArray();
    }
}
