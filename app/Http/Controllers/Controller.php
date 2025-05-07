<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Book;
use App\Models\Author;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Display the home page with latest books and authors
     */
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

    /**
     * Display the specified book
     */
    public function show($id)
    {
        $book = Book::with('author')->findOrFail($id);
        
        // Get other books by the same author
        $relatedBooks = Book::where('author_id', $book->author_id)
                           ->where('id', '!=', $book->id)
                           ->take(3)
                           ->get();

        return view('show', compact('book', 'relatedBooks'));
    }

    /**
     * Display the books listing page
     */
    public function books()
    {
        $books = Book::with('author')
                     ->latest()
                     ->paginate(12);

        return view('books', compact('books'));
    }

    /**
     * Display the authors listing page
     */
    public function authors()
    {
        $authors = Author::withCount('books')
                        ->latest()
                        ->paginate(12);

        return view('authors', compact('authors')); 
    }
}
