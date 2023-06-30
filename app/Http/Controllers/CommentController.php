<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
  
    /**
     * Store a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // $request = les données qui viennent du formulaire
                                            // $request['content'] = "salut les gars"
{
    // 1) VALIDATION DES DONNEES : on valide les champs en précisant les critères attendus
    $request->validate([
        //'name de l'input' => ['critères]
        'content' => 'required|min:25|max:1000',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif;svg|max:2048',
        'tags' => 'required|min:3|max:50',
        // autre syntaxe possible : 'content' => ['required', 'min:25', 'max:1000']
    ]);

    ;

    // 2) sauvegarde du commentaire => va lancer un insert into en SQL
    Comment::create([
                                         // 3 syntaxes possibles pour accèder au contenu de $request
        'content' => $request->content, // syntaxe objet
        'tags' => $request['tags'],     // syntaxe tableau associatif
        'image' => isset($request['image']) ? uploadImage($request['image']) : null,   // autre syntaxe
        'post_id' => $request['post_id'], // j'accède à l'id du post concerné
        'user_id' => Auth::user()->id, // j'accède à l'id du user connecté
    ]);


    //on redirige sur la page précédente
    return back()->with('message', 'Le commentaire a bien été envoyé !');
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        $this->authorize('update', $comment);
        return view('comment/edit', ['comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $request->validate([
            'content' => 'required|max:1000',
            'tags' => 'required|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif;svg|max:2048',
        ]);

         //on modifie les infos de l'utilisateur
         $comment->content = $request->input('content');
         $comment->tags = $request->input('tags');
         
         if (isset($request['image'])){
            $comment->image = uploadImage($request['image']);
      } 
 
         //on sauvegarde les changements en bdd
         $comment->save();
 
         //on redirige sur la page précédente
         return redirect()->route('home')-> with('message', 'Le commentaire a bien été modifié');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
        {
        $this->authorize('delete', $comment);

        //on vérifie que c'est bien l'utilisateur connecté qui fait la demande de suppression
        // ()les id doivent être identique)
        
            $comment->delete();
            return redirect()->route('home')->with('message', 'Le commentaire a bien été supprimé');
        }
    
}
