<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    protected $fillable = [
        'user_id',
        'author_id',
        'title',
        'year_of_publication',
        'num_of_pages',
        'genre',
        'cover',
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

        // static::forceDeleting(function ($book) {
        //     if ($book->cover) {
        //         Storage::disk('public')->delete($book->cover);
        //     }
        //     // Loop through each cover and delete it
        //     foreach ($book->covers as $cover) {
        //         Storage::disk('public')->delete($cover->path);
        //         $cover->delete();
        //     }
        // });
    }
}
