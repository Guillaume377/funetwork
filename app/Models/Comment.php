<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

     // je charge automatiquement l'utilisateur à chaque fois que je récupère un commentaire
     protected $with = ['user'];

     protected $fillable = [
         'content',
         'tags',
         'image',
         'post_id',
         'user_id',
     ];
    // nom de la fonction au singulier car 1 seule message en relation
    // cardinalité 1,1
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    //idem
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
