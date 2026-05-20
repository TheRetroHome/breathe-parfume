<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::withCount('products')->orderBy('type')->orderBy('name')->paginate(30);
        return view('admin.notes.index', compact('notes'));
    }

    public function create()
    {
        return view('admin.notes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:top,heart,base',
            'icon' => 'nullable|string|max:100',
        ]);

        $data['slug'] = Str::slug($data['name']);

        Note::create($data);

        return redirect()->route('admin.notes.index')->with('success', 'Нота создана!');
    }

    public function show(string $id)
    {
        abort(404);
    }

    public function edit(string $id)
    {
        $note = Note::findOrFail($id);
        return view('admin.notes.edit', compact('note'));
    }

    public function update(Request $request, string $id)
    {
        $note = Note::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:top,heart,base',
            'icon' => 'nullable|string|max:100',
        ]);

        $note->update($data);

        return redirect()->route('admin.notes.index')->with('success', 'Нота обновлена!');
    }

    public function destroy(string $id)
    {
        Note::findOrFail($id)->delete();
        return redirect()->route('admin.notes.index')->with('success', 'Нота удалена.');
    }
}
