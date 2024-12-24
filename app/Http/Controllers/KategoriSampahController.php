<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriSampahRequest;
use App\Models\KategoriSampah;
use Illuminate\Http\Request;

class KategoriSampahController extends Controller
{
    public function index()
    {
        $listKategori = KategoriSampah::all();
        return view('users.kategori_sampah', compact('listKategori'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KategoriSampahRequest $request)
    {
        $validasi = $request->validated();
        KategoriSampah::create($validasi);

        return redirect()->route('kategori-sampah.index')->with('success', 'Kategori sampah berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = KategoriSampah::findOrFail($id);

        return view('admin.kategori.show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = KategoriSampah::findOrFail($id);

        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KategoriSampahRequest $request, string $id)
    {
        $kategori = KategoriSampah::findOrFail($id);
        $validasi = $request->validated();
        $kategori->update($validasi);

        return redirect()->route('kategori-sampah.index')->with('success', 'Kategori sampah berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = KategoriSampah::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori-sampah.index')->with('success', 'Kategori sampah berhasil dihapus');
    }
}
