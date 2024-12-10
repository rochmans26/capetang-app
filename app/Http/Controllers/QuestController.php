<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestRequest;
use App\Models\Quest;
use Illuminate\Http\Request;

class QuestController extends Controller
{
    public function index()
    {
        $listQuest = Quest::all();

        return view('admin.quest.index', compact('listQuest'));
    }

    public function create()
    {
        return view('admin.quest.create');
    }

    public function store(QuestRequest $request)
    {
        $validasi = $request->validated();
        Quest::create($validasi);

        return redirect()->route('quest.index')->with('success', 'Quest berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $quest = Quest::findOrFail($id);

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
        $quest->update($validasi);

        return redirect()->route('quest.index')->with('success', 'Quest berhasil diubah');
    }

    public function destroy(string $id)
    {
        $quest = Quest::findOrFail($id);
        $quest->delete();

        return redirect()->route('quest.index')->with('success', 'Quest berhasil dihapus');
    }
}
