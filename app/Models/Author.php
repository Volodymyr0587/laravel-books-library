<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Author extends Model
{
    protected $fillable = ['name', 'bio'];
    /**
     * Get all of the books for the Author
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
    }
}
