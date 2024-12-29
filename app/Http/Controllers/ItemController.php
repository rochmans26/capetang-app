<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Item;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public $adminAkses = [
        'tambah-item',
        'ubah-item',
        'hapus-item',
    ];

    public function __construct()
    {
        $this->middleware('permission:lihat-item')->only(['index', 'show']);
        $this->middleware('permission:tambah-item')->only(['create', 'store']);
        $this->middleware('permission:ubah-item')->only(['edit', 'update']);
        $this->middleware('permission:hapus-item')->only(['destroy']);
    }

    public function index()
    {
        $listItem = Item::paginate(5);

        return request()->user()->canAny($this->adminAkses) ?
            view('admin.item.index', compact('listItem')) :
            redirect()->route('users.penukaran-poin');
    }

    public function create()
    {
        return view('admin.item.create');
    }

    public function store(ItemRequest $request)
    {
        $validasi = $request->validated();

        if ($request->hasFile('foto_item')) {
            $validasi['foto_item'] = Item::uploadImage($request->file('foto_item'));
        }

        item::create($validasi);

        return redirect()->route('item.index')
            ->with('success', 'item berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $item = item::findOrFail($id);

        return request()->user()->canAny($this->adminAkses) ?
            view('admin.item.show', compact('item')) :
            redirect()->route('users.penukaran-poin');
    }

    public function edit(string $id)
    {
        $item = item::findOrFail($id);

        return view('admin.item.edit', compact('item'));
    }

    public function update(ItemRequest $request, string $id)
    {
        $item = item::findOrFail($id);
        $validasi = $request->validated();

        if ($request->hasFile('foto_item')) {
            // Delete the old image if it exists
            $item->deleteImage($item->foto_item ?? null);

            // Store the new image in storage/app/public/uploads/item
            $validasi['foto_item'] = $item->uploadImage($request->file('foto_item'));
        }

        $item->update($validasi);

        return redirect()->route('item.index')
            ->with('success', 'item berhasil diubah');
    }

    public function destroy(string $id)
    {
        $item = item::findOrFail($id);
        $item->deleteImage($item->foto_item ?? null);
        $item->delete();

        return redirect()->route('item.index')
            ->with('success', 'item berhasil dihapus');
    }
}
