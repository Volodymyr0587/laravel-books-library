<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class GenreHelper
{
    /**
     * badgeColor
     *
     * @param  string $genre
     * @return string
     */
    public static function badgeColor(string $genre): string
    {
        return Str::startsWith(Str::lower($genre), ['a', 'e', 'i', 'o', 'u', 'y'])
                ? 'bg-indigo-100 text-indigo-800'
                : 'bg-rose-100 text-rose-800';
    }
}
