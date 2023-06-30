<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
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
        ]);;

        // 2) sauvegarde du message => va lancer un insert into en SQL
        Post::create([
            // 3 syntaxes possibles pour accèder au contenu de $request
            'content' => $request->content, // syntaxe objet
            'tags' => $request['tags'],     // syntaxe tableau associatif
            'image' => isset($request['image']) ? uploadImage($request['image']) : null,   // autre syntaxe
            'user_id' => Auth::user()->id // j'accède à l'id du user connecté
        ]);


        //on redirige sur la page précédente
        return back()->with('message', 'Le message a bien été envoyé !');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('post/edit', ['post' => $post]);
    }


    // ************************************************** Fonction modification Post *********************************** //
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'content' => 'required|max:1000',
            'tags' => 'required|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif;svg|max:2048',
        ]);

        //on modifie les infos de l'utilisateur
        $post->content = $request->input('content');
        $post->tags = $request->input('tags');
        
        if (isset($request['image'])){
              $post->image = uploadImage($request['image']);
        } 

        //on sauvegarde les changements en bdd
        $post->save();

        //on redirige sur la page précédente
        return redirect()->route('home')->with('message', 'Le message a bien été modifié');
    }

    // ************************************************** Fonction suppression Post *********************************** //
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
 
        //on vérifie que c'est bien l'utilisateur connecté qui fait la demande de suppression
        // ()les id doivent être identique)
        if (Auth::user()->id == $post->user_id) {
            $post->delete();
            return redirect()->route('home')->with('message', 'Le message a bien été supprimé');
        } else {
            return redirect()->back()->withErrors(['erreur' => 'suppression du post impossible']);
        }
    }
    // ************************************************** Fonction recherche (formulaire dans la Navbar) *********************************** //

    public function search(Request $request)
    {
        //je valide la saisie aves des critères
        $request->validate([
            //name de 'input' =>[critères]
            'search' => 'required|min:3|max:20|string'
        ]);

        // je récupère le mot clé et j'enlève les espaces autour pour la comparaison
        $keyword = trim($request->input('search')); // trim : enlever les espaces


        //je récupère les posts en fonction du mot clé dans la recherche
        $posts = Post::where('tags', 'like', "%{$keyword}%") //"%    %"= prendre en compte les caractères entourant le mot recherché
            ->orWhere('content', 'like', "%{$keyword}%")         // exemple : mot recherché "test" -> "%test%" = test, tester, détester,...
            ->paginate(10);                                             // 'like' = 'comme ce qui est recherché'

        return view('home', ['posts' => $posts]);
    }
}
