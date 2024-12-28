<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriSampahRequest;
use App\Models\KategoriSampah;
use Illuminate\Http\Request;

class KategoriSampahController extends Controller
{
    public $adminAkses = [
        'tambah-kategori-sampah',
        'ubah-kategori-sampah',
        'hapus-kategori-sampah',
    ];

    public function __construct()
    {
        $this->middleware('permission:lihat-kategori-sampah')->only(['index', 'show', 'indexForUser', 'showForUser']);
        $this->middleware('permission:tambah-kategori-sampah')->only(['create', 'store']);
        $this->middleware('permission:ubah-kategori-sampah')->only(['edit', 'update']);
        $this->middleware('permission:hapus-kategori-sampah')->only(['destroy']);
    }

    public function index()
    {
        $listKategori = KategoriSampah::paginate(5);

        return request()->user()->canAny($this->adminAkses) ?
            view('admin.kategori.index', compact('listKategori')) :
            redirect()->route('users.kategori-sampah');
    }

    public function indexForUser()
    {
        $listKategori = KategoriSampah::all();

        return !request()->user()->canAny($this->adminAkses) ?
            view('users.kategori_sampah', compact('listKategori')) :
            redirect()->route('kategori-sampah.index');
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(KategoriSampahRequest $request)
    {
        $validasi = $request->validated();

        if ($request->hasFile('gambar')) {
            $validasi['gambar'] = KategoriSampah::uploadImage($request->file('gambar'));
        }

        KategoriSampah::create($validasi);

        return redirect()->route('kategori-sampah.index')->with('success', 'Kategori sampah berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $kategori = KategoriSampah::findOrFail($id);

        return request()->user()->canAny($this->adminAkses) ?
            view('admin.kategori.show', compact('kategori')) :
            redirect()->route('users.detail-kategori-sampah', $kategori->id);
    }

    public function showForUser(string $id)
    {
        $kategori = KategoriSampah::findOrFail($id);

        return !request()->user()->canAny($this->adminAkses) ?
            view('admin.kategori.show', compact('kategori')) :
            redirect()->route('kategori-sampah.show', $kategori->id);
    }

    public function edit(string $id)
    {
        $kategori = KategoriSampah::findOrFail($id);

        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(KategoriSampahRequest $request, string $id)
    {
        $kategori = KategoriSampah::findOrFail($id);
        $validasi = $request->validated();

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            $kategori->deleteImage($kategori->gambar ?? null);

            $validasi['gambar'] = $kategori->uploadImage($request->file('gambar'));
        }

        $kategori->update($validasi);

        return redirect()->route('kategori-sampah.index')
            ->with('success', 'Kategori sampah berhasil diubah');
    }

    public function destroy(string $id)
    {
        $kategori = KategoriSampah::findOrFail($id);
        $kategori->deleteImage($kategori->gambar ?? null);
        $kategori->delete();

        return redirect()->route('kategori-sampah.index')
            ->with('success', 'Kategori sampah berhasil dihapus');
    }
}
