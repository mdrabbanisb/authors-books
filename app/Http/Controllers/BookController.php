<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $books = Book::with('author')->latest()->get();
        return view('admin.books.index', compact('books'));
    }

    public function show(Book $book)
    {
        return view('admin.books.show', compact('book'));
    }

    public function create()
    {
        $authors = Author::all();
        return view('admin.books.create', compact('authors'));
    }

    public function edit(Book $book)
    {
        $authors = Author::all();
        return view('admin.books.edit', compact('book', 'authors'));
    }

    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'author_id' => 'required|exists:authors,id',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image && file_exists(public_path($book->cover_image))) {
                unlink(public_path($book->cover_image));
            }

            $image = $request->file('cover_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->extension();
            $image->move(public_path('images/covers'), $imageName);
            $validatedData['cover_image'] = 'images/covers/' . $imageName;
        }

        $book->update($validatedData);

        return redirect()->route('admin.books.index')
            ->with('success', 'Book updated successfully');
    }

    public function destroy(Book $book)
    {
        if ($book->cover_image && file_exists(public_path($book->cover_image))) {
            unlink(public_path($book->cover_image));
        }

        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('success', 'Book deleted successfully');
    }
}
