<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
{
    $authors = Author::with('books')->get();
    return view('admin.authors.index', compact('authors'));
}

public function create()
{
    return view('admin.authors.create');
}

public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
    ]);

    Author::create($validatedData);

    return redirect()->route('admin.authors.index')
        ->with('success', 'Author created successfully');
}

public function show(Author $author)
{
    return view('admin.authors.show', compact('author'));
}

public function edit(Author $author)
{
    return view('admin.authors.edit', compact('author'));
}

public function update(Request $request, Author $author)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $author->update($validatedData);

    return redirect()->route('admin.authors.index')
        ->with('success', 'Author updated successfully');
}

public function destroy(Author $author)
{
    $author->delete();

    return redirect()->route('admin.authors.index')
        ->with('success', 'Author deleted successfully');
}
}
