<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('author')->get();
        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::all();
        return view('admin.books.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'published_at' => 'required|date',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6048',
            'author_id' => 'required|exists:authors,id',
        ]);

        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/covers'), $imageName);
            $validatedData['cover_image'] = 'images/covers/' . $imageName;
        }

        Book::create($validatedData);

        return redirect()->route('books.index')
            ->with('success', 'Book created successfully');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        $authors = Author::all();
        return view('admin.books.edit', compact('book', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'published_at' => 'required|date',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'author_id' => 'required|exists:authors,id',
        ]);

        $book = Book::findOrFail($id);

        if ($request->hasFile('cover_image')) {
            // Delete old image if exists
            if ($book->cover_image && file_exists(public_path($book->cover_image))) {
                unlink(public_path($book->cover_image));
            }

            $image = $request->file('cover_image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/covers'), $imageName);
            $validatedData['cover_image'] = 'images/covers/' . $imageName;
        }

        $book->update($validatedData);

        return redirect()->route('books.index')
            ->with('success', 'Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
