<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetorSampahRequest;
use App\Models\KategoriSampah;
use App\Models\SetorSampah;
use App\Models\User;

class SetorSampahController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:lihat-penyetoran-sampah')->only(['index', 'show']);
        $this->middleware('permission:tambah-penyetoran-sampah')->only(['create', 'store']);
        $this->middleware('permission:ubah-penyetoran-sampah')->only(['edit', 'update']);
        $this->middleware('permission:hapus-penyetoran-sampah')->only(['destroy']);
    }

    public function index()
    {
        $listSetoran = SetorSampah::paginate(5);
        return view('admin.transaksi.setor.index', compact('listSetoran'));
    }

    public function create()
    {
        $listUser = User::all();
        $listKategori = KategoriSampah::all();

        return view('admin.transaksi.setor.create', compact('listUser', 'listKategori'));
    }

    public function store(SetorSampahRequest $request)
    {
        $validasi = $request->validated();

        // Upload bukti penyerahan
        if ($request->hasFile('bukti_penyerahan')) {
            $validasi['bukti_penyerahan'] = SetorSampah::uploadImage($request->file('bukti_penyerahan'));
            $validasi['point'] = SetorSampah::hitungPoint($validasi['berat_sampah']);
        }

        $setorSampah = SetorSampah::create($validasi);
        $setorSampah->pencatatanReward($setorSampah);

        return redirect()->route('penyetoran-sampah.index')->with('success', 'Setor sampah berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $setorSampah = SetorSampah::findOrFail($id);
        return view('admin.transaksi.setor.show', compact('setorSampah'));
    }

    public function edit(string $id)
    {
        $listUser = User::all();
        $listKategori = KategoriSampah::all();
        $setorSampah = SetorSampah::findOrFail($id);

        return view('admin.transaksi.setor.edit', compact('setorSampah', 'listUser', 'listKategori'));
    }

    public function update(SetorSampahRequest $request, string $id)
    {
        $setorSampah = SetorSampah::findOrFail($id);
        $validasi = $request->validated();

        if (isset($setorSampah->point)) {
            $validasi['point'] = SetorSampah::hitungPoint($validasi['berat_sampah']);
        }

        if ($request->hasFile('bukti_penyerahan')) {
            // Hapus bukti penyerahan jika ada
            $setorSampah->deleteImage($setorSampah->bukti_penyerahan ?? null);
            // Simpan bukti penyerahan baru
            $validasi['bukti_penyerahan'] = $setorSampah->uploadImage($request->file('bukti_penyerahan'));
            $validasi['point'] = SetorSampah::hitungPoint($validasi['berat_sampah']);
        }

        $setorSampah->update($validasi);
        $setorSampah->updatePencatatanReward($setorSampah);

        return redirect()->route('penyetoran-sampah.index')->with('success', 'Setor sampah berhasil diubah');
    }

    public function destroy(string $id)
    {
        $setorSampah = SetorSampah::findOrFail($id);
        $setorSampah->deleteImage($setorSampah->bukti_penyerahan ?? null);
        $setorSampah->deletePencatatanReward($setorSampah);
        $setorSampah->delete();

        return redirect()->route('penyetoran-sampah.index')->with('success', 'Setor sampah berhasil dihapus');
    }
}
