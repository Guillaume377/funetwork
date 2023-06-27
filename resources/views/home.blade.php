@extends('layouts.app')

<!--icon-->
<script src="https://kit.fontawesome.com/826eec2b4c.js" crossorigin="anonymous"></script>

@section('content')
    <div class="container">
        <div class="row justify-content-center text-center">

            {{-- @if (Route::currentRouteName() == 'search')
                <h1 class="m-5">Résultats de la recherche</h1>
            @else --}}
            <h1 class="m-5">Accueil / liste de messages</h1>

            <h2 class="m-5">Poster un message</h2>

            <!--********************************************** formulaire ajout message *************************************-->

            <form action="{{ route('post.store') }}" method="post" class="message w-75 mx-auto">
                @csrf

                <!-- ******************************************* input content **********************************************-->

                <div class="row mb-3">
                    <i class="fas fa-pen-fancy text-primary fa-2x me-2"></i>
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
                            class="fa-solid fa-hashtag text-primary fa-2x me-2"></i></label>

                    <div class="col-md-6">
                        <input id="tags" type="text" class="form-control @error('tags') is-invalid @enderror"
                            name="tags" placeholder="bonjour hello" required autofocus>

                        @error('tags')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- ******************************************** input image post **********************************************-->

                <div class="row mb-3">
                    <label for="image" class="col-md-4 col-form-label text-md-end">{{ _('image') }}</label>

                    <div class="col-md-6">
                        <input id="image" type="text" class="form-control @error('image') is-invalid @enderror"
                            name="image" placeholder="image.jpg" autocomplete="image" autofocus>

                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- ******************************************** bouton Valider **********************************************-->

                <button type="submit" class=" valider btn btn-primary"></i>Valider</button>

            </form>


            <h2 class="m-5">Liste des messages</h2>

            <!-- s'il y a des résultats pour la recherche => message qui informe l'utilisateur -->

            {{-- @if (count($posts) == 0)
                <p>Aucun résultat pour votre recherche</p>
            @else --}}
            <!-- s'il y a des résultats => foreach classique -->


            <!-- *************************************** Boucle qui affiche les messages ***********************************************-->
            @foreach ($posts as $post)
                <div class="card text-bg-primary mb-3">
                    <div class="card-header row">
                        <div class="d-flex flex-column align-items-center col-4">
                            <img class="photo_user" src="images/{{ $post->user->image }} " alt="image profil">
                            posté par {{ $post->user->pseudo }}
                        </div>

                        <div class="col-4">
                            {{ $post->tags }}
                        </div>
                        <div class="col-md-4 d-flex justify-content-around">
                            posté {{ $post->created_at->diffForHumans() }}
                            @if ($post->created_at != $post->updated_at)
                                <div class="row">modifié {{ $post->updated_at->diffForHumans() }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="card-body">
                        <p>{{ $post->content }}</p>
                        <img class="photo_message" src="images/{{ $post->image }} " alt="image du post">
                    </div>

                </div>


                <!-- *************************************** Bouton commenter => mène à la page commentaire ***********************************************-->
                <div class="row col-4">
                    <div class="container">
                        <button class=" commenter btn btn-warning"
                            onclick="document.getElementById('formulairecommentaire{{ $post->id }}').style.display = 'block'">
                            Commenter
                        </button>
                    </div>
                </div>

                <!-- *************************************** Bouton modifier => mène à la page de modification du message ***********************************************-->
                <div class="row col-4">
                    {{-- @can('update', $post) --}}
                    <a href="{{ route('post.edit', $post) }}">
                        <button class="btn btn-info">Modifier</button>
                    </a>
                </div>
                {{-- @endcan --}}

                <!-- ********************************************************* Bouton supprimer le post **************************************************-->
                <div class="row col-4">
                    {{-- @can('delete', $post) --}}
                    <div class="container text-center">
                        <form action="{{ route('post.destroy', $post) }}" method="POST">
                            @csrf
                            @method ('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </div>
                </div>
                {{-- @endcan --}}

                <!--********************************************** formulaire ajout commentaire *************************************-->


                <div style="display:none" class="p-3 mb-2" id="formulairecommentaire{{ $post->id }}">
                    <form action="{{ route('comment.store') }}" method="POST" class="commentaire w-50 mx-auto">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">

                        <!-- ******************************************* input content commentaire **********************************************-->

                        <div class="row mb-3">
                            <i class="fas fa-pen-fancy text-primary fa-2x me-2"></i>
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
                                    class="fa-solid fa-hashtag text-primary fa-2x me-2"></i></label>

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

                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">{{ _('image') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="text"
                                    class="form-control @error('image') is-invalid @enderror" name="image"
                                    placeholder="image.jpg" autocomplete="image" autofocus>

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <button class="btn btn-danger"
                            onclick="document.getElementById('formulairecommentaire{{ $post->id }}').style.display = 'none'">
                            Annuler
                        </button> {{-- masquer le formulaire de commentaire --}}

                        <button type="submit" class=" valider btn btn-primary"></i>Valider</button>
                </div>
                </form>


                <!-- ******************************************** boucle qui affiche les commentaires**********************************************-->

                @foreach ($post->comments as $comment)
                    <div class="card w-75 bg-warning mb-3">
                        <div class="card-header row">
                            <div class="d-flex flex-column align-items-center col-4">
                                <img class="photo_user" src="images/{{ $comment->user->image }} " alt="imagePost">
                                posté par {{ $comment->user->pseudo }}
                            </div>

                            <div class="col-4">
                                {{ $comment->tags }}
                            </div>

                            <div class="col-md-4 d-flex justify-content-around">
                                posté {{ $comment->created_at->diffForHumans() }}
                                @if ($comment->created_at != $comment->updated_at)
                                    <div>modifié {{ $comment->updated_at->diffForHumans() }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="card-body">
                            <p>{{ $comment->content }}</p>
                            <img class="photo_commentaire" src="images/{{ $comment->image }} "
                                alt="image du commentaire">
                        </div>




                        <!-- *************************************** Bouton modifier => mène à la page de modification du commentaire ***********************************************-->
                        <div class="row">
                            <div class="col-6">
                                {{-- @can('update', $post) --}}
                                <a href="{{ route('comment.edit', $comment) }}">
                                    <button class="btn btn-info">Modifier</button>
                                </a>
                            </div>

                            {{-- @endcan --}}

                            <!-- ********************************************************* Bouton supprimer le commentaire **************************************************-->
                            <div class="col-6">
                                {{-- @can('delete', $post) --}}
                                <div class="container text-center">
                                    <form action="{{ route('comment.destroy', $comment) }}" method="POST">
                                        @csrf
                                        @method ('DELETE')
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- @endcan --}}
                @endforeach
            @endforeach






            <!-- Pagination -->
            {{ $posts->links() }}
        </div>
    </div>
@endsection
