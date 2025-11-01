<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoverController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $books = auth()->user()->books()
            ->select('id', 'cover', 'title')
            ->whereNotNull('cover')
            ->without('authors', 'genres')
            ->paginate(12);

        return view('books.covers', compact('books'));
    }
}
