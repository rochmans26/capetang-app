<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetorSampahRequest;
use App\Models\KategoriSampah;
use App\Models\Reward;
use App\Models\SetorSampah;
use App\Models\User;
use Illuminate\Http\Request;

class SetorSampahController extends Controller
{
    public function index()
    {
        $listSetoran = SetorSampah::all();
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
        $validasi['point'] = SetorSampah::hitungPoint($validasi['berat_sampah']);
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
        $validasi['point'] = SetorSampah::hitungPoint($validasi['berat_sampah']);
        $setorSampah->update($validasi);
        $setorSampah->updatePencatatanReward($setorSampah);

        return redirect()->route('penyetoran-sampah.index')->with('success', 'Setor sampah berhasil diubah');
    }

    public function destroy(string $id)
    {
        $setorSampah = SetorSampah::findOrFail($id);
        $setorSampah->delete();

        return redirect()->route('penyetoran-sampah.index')->with('success', 'Setor sampah berhasil dihapus');
    }
}
