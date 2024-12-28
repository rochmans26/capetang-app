<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestRequest;
use App\Models\Quest;
use Illuminate\Http\Request;

class QuestController extends Controller
{
    public $adminAkses = [
        'tambah-quest',
        'ubah-quest',
        'hapus-quest'
    ];

    public $userAkses = [
        'ambil-quest',
        'perbarui-quest',
        'batalkan-quest',
    ];

    public function __construct()
    {
        $this->middleware('permission:lihat-quest')->only(['index', 'show']);
        $this->middleware('permission:tambah-quest')->only(['create', 'store']);
        $this->middleware('permission:ubah-quest')->only(['edit', 'update']);
        $this->middleware('permission:hapus-quest')->only(['destroy']);
    }

    public function index()
    {
        $listQuest = Quest::paginate(5);

        return request()->user()->canAny($this->adminAkses) ?
            view('admin.quest.index', compact('listQuest')) :
            redirect()->route('users.list-quest');
    }

    public function create()
    {
        return view('admin.quest.create');
    }

    public function store(QuestRequest $request)
    {
        $validasi = $request->validated();

        if ($request->hasFile('gambar')) {
            $validasi['gambar'] = Quest::uploadImage($request->file('gambar'));
        }

        Quest::create($validasi);

        return redirect()->route('quest.index')->with('success', 'Quest berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $quest = Quest::findOrFail($id);

        return request()->user()->canAny($this->adminAkses) ?
            view('admin.quest.show', compact('quest')) :
            redirect()->route('users.info-quest-user', $quest->id);

        return view('admin.quest.show', compact('quest'));
    }

    public function edit(string $id)
    {
        $quest = Quest::findOrFail($id);

        return view('admin.quest.edit', compact('quest'));
    }

    public function update(QuestRequest $request, string $id)
    {
        $quest = Quest::findOrFail($id);
        $validasi = $request->validated();

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            $quest->deleteImage($quest->gambar ?? null);

            $validasi['gambar'] = $quest->uploadImage($request->file('gambar'));
        }

        $quest->update($validasi);

        return redirect()->route('quest.index')
            ->with('success', 'Quest berhasil diubah');
    }

    public function destroy(string $id)
    {
        $quest = Quest::findOrFail($id);
        $quest->delete();

        return redirect()->route('quest.index')
            ->with('success', 'Quest berhasil dihapus');
    }
}
