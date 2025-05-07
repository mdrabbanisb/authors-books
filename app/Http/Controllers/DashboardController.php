<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;

class DashboardController extends Controller
{
    //
    public function dashboard()
    {
        $totalAuthors = Author::count();
        $totalBooks = Book::count();
        $latestAuthors = Author::latest()->take(5)->get();
        $latestBooks = Book::with('author')->latest()->take(5)->get();
        
        return view('dash', compact('totalAuthors', 'totalBooks', 'latestAuthors', 'latestBooks'));
    }
}
