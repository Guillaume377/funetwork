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
            'image' => 'nullable|string',
            'tags' => 'required|min:3|max:50',
            // autre syntaxe possible : 'content' => ['required', 'min:25', 'max:1000']
        ]);

       ;

       // 2) sauvegarde du message => va lancer un insert into en SQL
        Post::create([
                                            // 3 syntaxes possibles pour accèder au contenu de $request
            'content' => $request->content, // syntaxe objet
            'tags' => $request['tags'],     // syntaxe tableau associatif
            'image' => $request->input('image'),   // autre syntaxe
            'user_id' => Auth::user()->id // j'accède à l'id du user connecté
        ]);


        //on redirige sur la page précédente
        return back()->with('message', 'Le message a bien été envoyé !');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
