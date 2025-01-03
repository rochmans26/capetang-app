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
        'tipe_pengambilan',
        'bukti_penyerahan',
    ];

    public function item()
    {
        return $this->belongsToMany(Item::class, 'pivot_transaksi_tukar_poin_item', 'id_transaksi', 'id_item')->withPivot('jumlah_item');
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetailPenukaranPoin::class, 'id_transaksi', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function pencatatanReward($tukarPoin)
    {
        Reward::create([
            'nama_reward' => 'Transaksi Tukar Poin',
            'id_user' => $tukarPoin->id_user,
            'id_transaksi' => $tukarPoin->id,
            'tipe_transaksi' => $tukarPoin->getMorphClass(),
            'point_reward' => -$tukarPoin->total_transaksi,
        ]);
    }

    public function updatePencatatanReward($tukarPoin)
    {
        Reward::where([
            ['id_transaksi', '=', $tukarPoin->id],
            ['tipe_transaksi', '=', $tukarPoin->getMorphClass()]
        ])
            ->update([
                'id_user' => $tukarPoin->id_user,
                'point_reward' => -$tukarPoin->total_transaksi,
            ]);
    }

    public function deletePencatatanReward($tukarPoin)
    {
        Reward::where([
            ['id_transaksi', '=', $tukarPoin->id],
            ['tipe_transaksi', '=', $tukarPoin->getMorphClass()]
        ])->delete();
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
