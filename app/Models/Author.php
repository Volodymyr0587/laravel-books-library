<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    protected $fillable = ['user_id', 'name', 'bio', 'author_photo'];
    /**
     * Get all of the books for the Author
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }

    /**
     * Get the user that owns the Author
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearchByName($query, $searchTerm)
    {
        if ($searchTerm) {
            return $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%');
            });
        }

        return $query;
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($author) {

            if (request()->hasFile('author_photo')) {
                if ($author->getOriginal('author_photo')) {
                    Storage::disk('public')->delete($author->getOriginal('author_photo'));
                }
            }
        });

        static::deleting(function ($author) {
            if ($author->author_photo) {
                Storage::disk('public')->delete($author->author_photo);
            }
        });
    }
}
