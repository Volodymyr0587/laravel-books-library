<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->query('search');

        $query = auth()->user()->authors()
            ->searchByName($searchTerm);

        $authors = $query->latest()->paginate(6)->withQueryString();

        return view('authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $authorData = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:5000',
            'author_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // dd($authorData);

        $authorData['author_photo'] = $this->handleAuthorImageUpload($request);

        // dd($authorData);

        $author = auth()->user()->authors()->create($authorData);

        return to_route('authors.index')->with('success', "Author $author->name successfully added to your library");
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        Gate::authorize('editAuthor', $author);

        return view('authors.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        Gate::authorize('editAuthor', $author);

        return view('authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        Gate::authorize('editAuthor', $author);

        $authorData = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:5000',
            'author_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Обробка зображення
        if ($request->hasFile('author_photo')) {
            $authorData['author_photo'] = $this->handleAuthorImageUpload($request);
        }

        $author->update($authorData);

        return to_route('authors.index')->with('success', "Author $author->name successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        Gate::authorize('editAuthor', $author);

        if ($author->books()->exists()) {
            // Optionally handle reassignment or deletion of the related books
            $count = $author->books()->count();

            // Generate the link to view all books by this author
            $booksLink = route('books.index', ['author_id' => $author->id]);
            // Create the warning message with the link
            $message = "This author has $count associated " . Str::plural('book', $count) .
                " and cannot be deleted. <a href=\"$booksLink\" class=\"text-blue-500 underline\">View all books by this author</a>.";

            return redirect()->back()->with('warning', $message);
        }

        $author->delete();

        return to_route('authors.index')->with('success', "Author $author->name successfully deleted");
    }

    protected function handleAuthorImageUpload($request)
    {
        if ($request->hasFile('author_photo')) {
            return $request->file('author_photo')->store('authors', 'public');
        }

        return null;
    }
}
