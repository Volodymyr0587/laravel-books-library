<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'year_of_publication',
        'num_of_pages',
        'cover',
        'description',
    ];

    /**
     * Get the user that owns the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the author that owns the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }

    /**
     * The genres that belong to the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'book_genre');
    }

    public function scopeSearchByAuthorTitleDescription($query, $searchTerm)
    {
        if ($searchTerm) {
            return $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                ->orWhere('description', 'like', '%' . $searchTerm . '%')
                ->orWhereHas('authors', function ($authorQuery) use ($searchTerm) {
                    $authorQuery->where('name', 'like', '%' . $searchTerm . '%');
                });
            });
        }

        return $query;
    }

    public function scopeFilterByGenre(Builder $query, $genreId): Builder
    {
        return $genreId ? $query->whereHas('genres', function ($q) use ($genreId) {
            $q->where('genres.id', $genreId);
        }) : $query;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Generate a unique slug for the note.
     *
     * @return void
     */
    protected function generateSlug()
    {
        $slug = Str::slug($this->title);
        $count = static::where('slug', 'LIKE', "{$slug}%")->count();
        $this->slug = $count ? "{$slug}-{$count}" : $slug;
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($book) {
            $book->generateSlug();

            if (request()->hasFile('cover')) {
                if ($book->getOriginal('cover')) {
                    Storage::disk('public')->delete($book->getOriginal('cover'));
                }
            }
        });

        static::deleting(function ($book) {
            if ($book->cover) {
                Storage::disk('public')->delete($book->cover);
            }
        });
    }
}
