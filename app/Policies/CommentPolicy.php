<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{

    /* l'administrateur peut modifier et supprimer tous les commentaires */
    public function before(User $user, $ability)
    {
        if ($user->isAdmin()) {
          return true;
        }
    }

    /**
     * Seul l'auteur du commentaire peut modifier son commentaire.
     */
    public function update(User $user, Comment $comment): bool
    {
        return $user->id == $comment->user_id;
    }

    /**
     * L'auteur du post peut supprimer un commentaire d'une autre personne.
     * Et seul l'auteur du commentaire peut supprimer son commentaire.
     */
    public function delete(User $user, Comment $comment): bool
    {
        return $user->id == $comment->user_id || $user->id == $comment->post->user_id;

    }

}
