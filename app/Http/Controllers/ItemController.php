<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Item;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index()
    {
        $listItem = Item::all();
        return view('users.tukar_poin', compact('listItem'));
    }

    public function create()
    {
        return view('admin.item.create');
    }

    public function store(ItemRequest $request)
    {
        $validasi = $request->validated();

        if ($request->hasFile('foto_item')) {
            $validasi['foto_item'] = Item::uploadItemImage($request->file('foto_item'));
        }

        item::create($validasi);

        return redirect()->route('item.index')->with('success', 'item berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $item = item::findOrFail($id);

        return view('admin.item.show', compact('item'));
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
            if ($item->foto_item) {
                Item::deleteItemImage($item->foto_item);
            }

            // Store the new image in storage/app/public/uploads/item
            $validasi['foto_item'] = Item::uploadItemImage($request->file('foto_item'));
        }

        $item->update($validasi);

        return redirect()->route('item.index')->with('success', 'item berhasil diubah');
    }

    public function destroy(string $id)
    {
        $item = item::findOrFail($id);

        if ($item->foto_item) {
            Item::deleteItemImage($item->foto_item);
        }

        $item->delete();

        return redirect()->route('item.index')->with('success', 'item berhasil dihapus');
    }
}
