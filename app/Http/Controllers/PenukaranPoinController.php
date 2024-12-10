<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenukaranPoinRequest;
use App\Models\TransaksiTukarPoint;

class PenukaranPoinController extends Controller
{
    public function index()
    {
        $listTransaksi = TransaksiTukarPoint::all();
        return view('admin.transaksi.index', compact('listTransaksi'));
    }

    public function create()
    {
        return view('admin.transaksi.create');
    }

    public function store(PenukaranPoinRequest $request)
    {
        $validasi = $request->validated();
        TransaksiTukarPoint::create($validasi);

        return redirect()->route('penukaran-poin.index')->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $tukar = TransaksiTukarPoint::findOrFail($id);

        return view('admin.transaksi.show', compact('tukar'));
    }

    public function edit(string $id)
    {
        $tukar = TransaksiTukarPoint::findOrFail($id);

        return view('admin.transaksi.edit', compact('tukar'));
    }

    public function update(PenukaranPoinRequest $request, string $id)
    {
        $tukar = TransaksiTukarPoint::findOrFail($id);
        $validasi = $request->validated();
        $tukar->update($validasi);

        return redirect()->route('penukaran-poin.index')->with('success', 'Tukar berhasil diubah');
    }

    public function destroy(string $id)
    {
        $tukar = TransaksiTukarPoint::findOrFail($id);
        $tukar->delete();

        return redirect()->route('penukaran-poin.index')->with('success', 'Tukar berhasil dihapus');
    }
}
