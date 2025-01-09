<?php

namespace App\Helpers;

use App\Models\Genre;
use Illuminate\Support\Str;

class GenreHelper
{
    /**
     * badgeColor
     *
     * @param  Genre $genre
     * @return string
     */
    public static function badgeColor(Genre $genre): string
    {
        return Str::startsWith(Str::lower($genre->name), ['a', 'e', 'i', 'o', 'u', 'y'])
                ? 'bg-indigo-100 text-indigo-800'
                : 'bg-yellow-100 text-yellow-800';
    }
}
