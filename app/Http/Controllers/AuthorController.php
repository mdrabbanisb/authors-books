<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;

class AuthorController extends Controller
{
    public function index()
    {
        // Logic to list all authors
        $authors = Author::all();
        return view('admin.authors.index', ['authors' => $authors]);
    }

    public function create()
    {
        return view('admin.authors.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        // Logic to store a new author
        $author = new Author();
        $author->name = $validatedData['name'];
        $author->save();
        return redirect()->route('authors.index');
    }

    public function show($id)
    {
        $author = Author::findOrFail($id);
        return view('authors.show', compact('author'));
    }

    public function edit($id)
    {
        $author = Author::findOrFail($id);
        return view('admin.authors.edit', compact('author'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $author = Author::findOrFail($id);
        $author->name = $validatedData['name'];
        $author->save();

        return redirect()->route('authors.index')
            ->with('success', 'Author updated successfully');
    }

    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        return redirect()->route('authors.index')
            ->with('success', 'Author deleted successfully');
    }
    
}
