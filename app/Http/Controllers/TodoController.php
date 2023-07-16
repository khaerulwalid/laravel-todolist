<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index() {
        return view('welcome', [
            'todos' => Todo::all()
        ]);
    }

    public function store(Request $request) {
        $validateData = $request->validate([
            'title' => 'required',
            'description' => 'nullable'
        ], [
            'title.required' => 'Title Wajid Diisi'
        ]);

        Todo::create($validateData);

        return redirect('/')->with('success', 'Berhasil simpan data');
    }

    public function update(Todo $todo) {

        if($todo->isDone) {
            $todo->update(['isDone' => false]);
        } else {
            $todo->update(['isDone' => true]);
        }
        

        return redirect('/');
    }

    public function destroy(Todo $todo) {
        $todo->delete();

        return redirect('/');
    }
}
