<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SetorSampah extends Model
{
    use HasFactory;

    protected $table = 'setor_sampah';

    protected $fillable = [
        'tgl_setor_sampah',
        'id_user',
        'id_kategori',
        'berat_sampah',
        'bukti_penyerahan',
        'point',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriSampah::class, 'id_kategori', 'id');
    }

    public function reward()
    {
        return $this->hasMany(Reward::class, 'id_transaksi', 'id');
    }

    /*
     * Helper untuk menghitung point berdasarkan berat sampah
     */
    public static function hitungPoint($beratSampah)
    {
        return floor($beratSampah / 100);
    }

    public function pencatatanReward($setorSampah)
    {
        Reward::create([
            'nama_reward' => 'Setor Sampah',
            'id_user' => $setorSampah->id_user,
            'id_transaksi' => $setorSampah->id,
            'tipe_transaksi' => $setorSampah->getMorphClass(),
            'point_reward' => $setorSampah->point,
        ]);
    }

    public function updatePencatatanReward($setorSampah)
    {
        Reward::where([
            ['id_transaksi', '=', $setorSampah->id],
            ['tipe_transaksi', '=', $setorSampah->getMorphClass()]
        ])->update([
            'id_user' => $setorSampah->id_user,
            'point_reward' => $setorSampah->point,
        ]);
    }

    public function deletePencatatanReward($setorSampah)
    {
        Reward::where([
            ['id_transaksi', '=', $setorSampah->id],
            ['tipe_transaksi', '=', $setorSampah->getMorphClass()]
        ])->delete();
    }

    public function getImageUrlAttribute()
    {
        if (!$this->bukti_penyerahan) {
            return asset('img/sample-item-card.jpg');
        }
        return Storage::url('public/uploads/setor-sampah/' . $this->bukti_penyerahan);
    }

    public static function uploadImage($file)
    {
        $fileName = time() . '.' . $file->extension();
        $file->storeAs('public/uploads/setor-sampah', $fileName);
        return $fileName;
    }

    public static function deleteImage($fileName)
    {
        return Storage::exists('public/uploads/setor-sampah/' . $fileName) && Storage::delete('public/uploads/setor-sampah/' . $fileName);
    }

    public function scopeGrafikSetorSampah($query, $bulan)
    {
        return $query
            ->selectRaw('MONTH(tgl_setor_sampah) as month, SUM(berat_sampah) as total')
            ->groupBy('month')
            ->get()
            ->values()
            ->mapWithKeys(function ($value) use ($bulan) {
                return [$bulan[$value['month'] - 1] => $value['total']];
            })->toArray();
    }

    public function scopeBeratPerKategori($query)
    {
        // Ambil semua kategori sampah
        $kategoriSampah = KategoriSampah::pluck('nama_kategori', 'id')->toArray();

        // Ambil total berat per kategori, jika tidak ada maka akan menghasilkan array kosong
        $result = $query
            ->selectRaw('id_kategori, SUM(berat_sampah) as total')
            ->groupBy('id_kategori')
            ->pluck('total', 'id_kategori')
            ->toArray();

        // Gabungkan kategori sampah dengan total berat, jika tidak ada data berat, set ke 0
        return collect($kategoriSampah)->mapWithKeys(function ($name, $id) use ($result) {
            return [$name => $result[$id] ?? 0]; // Jika tidak ada total, beri nilai 0
        });
    }
}
