<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\Mailables\Content;
use App\Models\Comment;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // seuls les invités non-connectés peuvent voir l'index (inscription  connexion)
        $this->middleware('guest')->only('index');

        // seuls les visiteurs connectés peuvent voir la liste des messages
        $this->middleware('auth')->only('home');
    }

    public function index() // renvoyer la page d'accueil du site (inscription + connexion)
    {                       // index.blade.php

        return view('index');
    }

    public function home() // renvoyer la page home.blade.php avec tous les messages

    {

        // *************************** RECUPERATION DES MESSAGES ***********************

        //1. syntaxe de base : on récupère tous les messages
        //$posts = Post::all();

        // je teste cette liste de message
        //dd($posts); //dump and die (dd)

        // 2. syntaxe avec le + récent en 1er
        //$posts = Post::latest()->get();

        // je teste cette liste de message
        //dd($posts); //dump and die (dd)

        // 3. syntaxe avec le + récent en 1er + la pagination
        //$posts = Post::latest()->paginate(10);

        // je teste cette liste de messages
        //dd ($posts);

        // ***************************** EAGER LOADINGS DE BASE *************************************


        // **************************EAGER LOADING méthode 1 : with *****************************

        // je veux charger en + de mes posts :
        // - les commentaires associés à chaque post
        // - l'utilisateur qui a posté chaque post

        //$posts = Post::with('comments', 'user')->latest()->paginate(10);

        // je teste cette liste de messages
        //dd ($posts);


        // ************************** EAGER LOADING méthode 2 : load *****************************

        // je récupère les messages avec le dernier en premier et par page de 10
        //$posts = Post::latest()->paginate(10);
        // je charge les relations souhaitées (comme ci-dessus)
        //$posts->load('comments', 'user');

        // je teste cette liste de messages
        //dd ($posts);

        // ************************ EAGER LOADING AVANCE : encapsulé ("nested eager loading") *******

        // je veux charger en + l'utilisateur qui a posté chaque commentaire
        $posts = Post::with('comments.user', 'user')->latest()->paginate(10);
        //dd($posts);

        //je retourne la vue home en y injectant les posts
        return view('home', ['posts' =>$posts]);

        
        // autre syntaxe
        //return view ('home', compact('posts'));





        
        // mettre en premier le commentaire le plus récent
        // $comments = Comment::with ('comments.user', 'user')->latest();

        // return view ('home', ['comments' =>$comments]);


    }
}
