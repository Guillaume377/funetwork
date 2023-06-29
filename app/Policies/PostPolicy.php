<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{

    /* l'administrateur peut modifier et supprimer tous les posts */
    public function before(User $user, $ability)
    {
        if ($user->isAdmin()) {
          return true;
        }
    }

    /**
     * Seul l'auteur du post peut modifier son post.
     */
    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * Seul l'auteur du post peut supprimer son post.
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

}
