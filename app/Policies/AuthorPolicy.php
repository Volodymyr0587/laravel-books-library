<?php

namespace App\Policies;

use App\Models\Author;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AuthorPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function editAuthor(User $user, Author $author): bool
    {
        return $author->user->is($user);
    }
}
