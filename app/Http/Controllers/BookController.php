<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = auth()->user()->books()->with('author')->latest()->paginate(10);
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::all(); // To populate author dropdown
        return view('books.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $bookData = $request->validated();

        $bookData['cover'] = $this->handleCoverImageUpload($request);

        $book = auth()->user()->books()->create($bookData);

        return to_route('books.index')->with('success', "Book $book->title successfully created");
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        Gate::authorize('editBook', $book);

        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        Gate::authorize('editBook', $book); // Ensure only the owner can edit
        $authors = Author::all();
        return view('books.edit', compact('book', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        Gate::authorize('editBook', $book);

        $bookData = $request->validated();

        // Обробка зображення
        if ($request->hasFile('cover')) {
            $bookData['cover'] = $this->handleCoverImageUpload($request);
        }

        $book->update($bookData);

        return to_route('books.index')->with('success', "Book $book->title successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        Gate::authorize('editBook', $book);

        $book->delete();

        return to_route('books.index')->with('success', "Book $book->title successfully deleted");
    }

    protected function handleCoverImageUpload($request)
    {
        if ($request->hasFile('cover')) {
            return $request->file('cover')->store('covers', 'public');
        }

        return null;
    }
}

