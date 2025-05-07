<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;

class ChatbotController extends Controller
{
    public function query(Request $request)
    {
        $query = strtolower($request->input('query', ''));
        
        switch($query) {
            case 'how many authors are there?':
                $count = Author::count();
                return response()->json([
                    'response' => "There are {$count} authors in the database."
                ]);

            case 'how many books are available?':
                $count = Book::count();
                return response()->json([
                    'response' => "There are {$count} books available."
                ]);

            case 'list top 5 authors.':
                $authors = Author::withCount('books')
                    ->orderByDesc('books_count')
                    ->take(5)
                    ->get()
                    ->map(function($author) {
                        return "- {$author->name} ({$author->books_count} books)";
                    })
                    ->join("\n");
                return response()->json([
                    'response' => "Here are the top 5 authors by number of books:\n{$authors}"
                ]);

            default:
                return response()->json([
                    'response' => "I can answer these questions:\n- How many authors are there?\n- How many books are available?\n- List top 5 authors."
                ]);
        }
    }
}
