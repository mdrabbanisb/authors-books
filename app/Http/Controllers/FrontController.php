<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;

class FrontController extends Controller
{
    public function index()
    {
        $books = Book::with('author')
                     ->latest()
                     ->take(6)
                     ->get();

        $authors = Author::withCount('books')
                        ->latest()
                        ->take(6)
                        ->get();

        return view('index', compact('books', 'authors'));
    }

    // ✅ FIXED
    public function show(Book $book)
    {
        $relatedBooks = Book::where('author_id', $book->author_id)
                            ->where('id', '!=', $book->id)
                            ->take(3)
                            ->get();

        return view('show', compact('book', 'relatedBooks'));
    }

    public function books()
    {
        $books = Book::with('author')
                     ->latest()
                     ->paginate(12);

        return view('books', compact('books'));
    }

    public function authors()
    {
        $authors = Author::withCount('books')
                         ->latest()
                         ->paginate(12);

        return view('authors', compact('authors'));
    }
}
