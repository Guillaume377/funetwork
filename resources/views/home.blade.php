<!--===================================PAGE REGROUPANT LES POSTS ET COMMENTAIRES====================================-->


@extends('layouts.app')

<!--icon-->
<script src="https://kit.fontawesome.com/826eec2b4c.js" crossorigin="anonymous"></script>

@section('content')
    <div class="container">
        <div class="row justify-content-center text-center">

            @if (Route::currentRouteName() == 'search')
                <h1>Résultats de la recherche</h1>
            @else
                <div class="container accueil">
                    <h1 class="p-5">Bienvenue sur votre réseau social <span>Funetwork!</h1>
                </div>

                <div class="container titre">
                    <h2 class="p-5">Poster un message</h2>
                </div>

                <!--********************************************** formulaire ajout message *************************************-->

                <form action="{{ route('post.store') }}" enctype="multipart/form-data" {{-- enctype = pour UPLOAD --}} method="post"
                    class="message w-75 mx-auto">
                    @csrf

                    <!-- ******************************************* input content **********************************************-->

                    <div class="row mb-3">
                        <i class="pen fas fa-pen-fancy fa-2x m-2"></i>
                        <label for="content">Ecris ton message</label>
                        <textarea required class="container-fluid mt-2" type="text" name="content" id="content" placeholder="Salut !"></textarea>

                        @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <!-- ******************************************** input tags **********************************************-->

                    <div class="row mb-3">
                        <label for="tags" class="col-md-4 col-form-label text-md-end"><i
                                class="hashtag fa-solid fa-hashtag fa-2x me-2"></i></label>

                        <div class="col-md-6">
                            <input id="tags tagspost" type="text"
                                class="form-control @error('tags') is-invalid @enderror" name="tags"
                                placeholder="bonjour hello" required autofocus>

                            @error('tags')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- ******************************************** input image post **********************************************-->

                    <!-- ***************UPLOAD IMAGE*********** -->
                    <div class="form-group row">

                        <label for="image"
                            class="col-md-4 col-form-label text-md-right d-flex justify-content-end">{{ __('image (facultative)') }}</label>

                        <div class="col-md-6">
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>

                    <!-- ******************************************** bouton Valider **********************************************-->

                    <button type="submit" class="Modif-Valid btn m-2"></i>Valider</button>

                </form>
            @endif


            <!-- ************s'il y a des résultats pour la recherche => message qui informe l'utilisateur *******************-->

            @if (count($posts) == 0)
                <p>Aucun résultat pour votre recherche</p>
                <img class="sorry w-50" src="images/sorry2.jpg" alt="image aucun résultat">
            @else
                <!-- s'il y a des résultats => foreach classique -->

                <div class="container titre">
                    <h2 class="p-5">Liste des messages</h2>
                </div>

                <!-- *************************************** Boucle qui affiche les messages ***********************************************-->
                @foreach ($posts as $post)
                    <div class="card card-post mb-3">
                        <div class="card-header post row pt-2">
                            <div class="d-flex flex-column align-items-center col-4">
                                @if ($post->user->image)
                                    <img class="photo_user" src="images/{{ $post->user->image }} " alt="image profil">
                                @endif

                                <!------- lien vers le profil public ------->
                                <a href="{{ route('users.show', $post->user) }}">
                                    <strong>{{ $post->user->pseudo }}</strong>
                                </a>
                            </div>

                            <div class="col-4">
                                <h4>#{{ implode(' #', explode(' ', $post->tags)) }} </h4>
                            </div>
                            <div class="poste-modifie col-4 d-flex justify-content-around">
                                posté {{ $post->created_at->diffForHumans() }}
                                @if ($post->created_at != $post->updated_at)
                                    <div class="row">modifié {{ $post->updated_at->diffForHumans() }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="card-body card-post ">
                            <p>{{ $post->content }}</p>
                            <img class="photo_message" src="images/{{ $post->image }} " alt="image du post">


                            <!-- *************************************** Bouton modifier => mène à la page de modification du message ***********************************************-->
                            <div class="row">
                                <div class="col-4">
                                    {{-- @can('fonction de PostPolicy.php, class Post de AuthServiceProvider.php') --}}
                                    @can('update', $post)
                                        <a href="{{ route('post.edit', $post) }}">
                                            <button class="Modif-Valid btn my-3">Modifier</button>
                                        </a>
                                    @endcan
                                </div>


                                <!-- *************************************** Bouton commenter => mène à la page commentaire ***********************************************-->
                                <div class="col-4">
                                    <div class="container">
                                        <button class=" Commenter btn my-3"
                                            onclick="document.getElementById('formulairecommentaire{{ $post->id }}').style.display = 'block'">
                                            Commenter
                                        </button>
                                    </div>
                                </div>


                                <!-- ********************************************************* Bouton supprimer le post **************************************************-->
                                <div class="col-4">
                                    {{-- @can('fonction de PostPolicy.php, class Post de AuthServiceProvider.php') --}}
                                    @can('delete', $post)
                                        <div class="container text-center">
                                            <form action="{{ route('post.destroy', $post) }}" method="POST">
                                                @csrf
                                                @method ('DELETE')
                                                <button type="submit" class="Supprimer btn my-3">Supprimer</button>
                                            </form>
                                        </div>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--******************************************************* formulaire ajout commentaire *************************************-->


                    <div style="display:none" class="p-3 mb-2" id="formulairecommentaire{{ $post->id }}">
                        <form action="{{ route('comment.store') }}"enctype="multipart/form-data" {{-- enctype = pour UPLOAD --}}
                            method="POST" class="commentaire w-50 mx-auto">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">

                            <!-- ******************************************* input content commentaire **********************************************-->

                            <div class="row mb-3">
                                <i class="pen fas fa-pen-fancy fa-2x m-2"></i>
                                <label for="content">Ecris ton commentaire</label>
                                <textarea required class="container-fluid mt-2" type="text" name="content" id="content" placeholder="Salut !"></textarea>

                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <!-- ******************************************** input tags commentaire **********************************************-->

                            <div class="row mb-3">
                                <label for="tags" class="col-md-4 col-form-label text-md-end"><i
                                        class="hashtag fa-solid fa-hashtag fa-2x me-2"></i></label>

                                <div class="col-md-6">
                                    <input id="tags" type="text"
                                        class="form-control @error('tags') is-invalid @enderror" name="tags"
                                        placeholder="bonjour hello" required autofocus>

                                    @error('tags')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- ******************************************** input image commentaire**********************************************-->


                            <!-- ***************UPLOAD IMAGE*********** -->
                            <div class="form-group row">

                                <label for="image"
                                    class="col-md-4 col-form-label text-md-right d-flex justify-content-end">{{ __('image (facultative)') }}</label>

                                <div class="col-md-6">
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>

                            <!-- ***************Bouton annuler et valider*********** -->

                            <button type="submit" class="Modif-Valid btn m-2"></i>Valider</button>

                            <button class="Supprimer btn m-2"
                                onclick="document.getElementById('formulairecommentaire{{ $post->id }}').style.display = 'none'">
                                Annuler
                            </button> {{-- masquer le formulaire de commentaire --}}


                    </div>
                    </form>


                    <!-- ******************************************** boucle qui affiche les commentaires**********************************************-->

                    @foreach ($post->comments as $comment)
                        <div class="card card-ins-cnx-com w-75 mb-3">
                            <div class="card-header ins-cnx-com row pt-3">
                                <div class="d-flex flex-column align-items-center col-4">
                                    @if ($comment->user->image)
                                        <img class="photo_user" src="images/{{ $comment->user->image }} "
                                            alt="imagePost">
                                    @endif
                                    {{ $comment->user->pseudo }}
                                </div>

                                <div class="col-4">
                                    <h4>#{{ implode(' #', explode(' ', $comment->tags)) }} </h4>
                                </div>

                                <div class="poste-modifie col-md-4 d-flex justify-content-around">
                                    posté {{ $comment->created_at->diffForHumans() }}
                                    @if ($comment->created_at != $comment->updated_at)
                                        <div>modifié {{ $comment->updated_at->diffForHumans() }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="card-body card-ins-cnx-com">
                                <p>{{ $comment->content }}</p>
                                <img class="photo_commentaire mb-3" src="images/{{ $comment->image }} "
                                    alt="image du commentaire">




                                <!-- *************************************** Bouton modifier => mène à la page de modification du commentaire ***********************************************-->
                                <div class="row">
                                    <div class="col-6">
                                        {{-- @can('fonction de CommentPolicy.php, class Post de AuthServiceProvider.php') --}}
                                        @can('update', $comment)
                                            <a href="{{ route('comment.edit', $comment) }}">
                                                <button class="Modif-Valid btn">Modifier</button>
                                            </a>
                                        @endcan
                                    </div>


                                    <!-- ********************************************************* Bouton supprimer le commentaire **************************************************-->
                                    <div class="col-6">
                                        {{-- @can('fonction de CommentPolicy.php, class Post de AuthServiceProvider.php') --}}
                                        @can('delete', $comment)
                                            <div class="container text-center">
                                                <form action="{{ route('comment.destroy', $comment) }}" method="POST">
                                                    @csrf
                                                    @method ('DELETE')
                                                    <button type="submit" class="Supprimer btn">Supprimer</button>
                                                </form>
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            @endif



            <!-- Pagination -->
            {{ $posts->links() }}
        </div>
    </div>
@endsection
