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

                <!-- ******************************************** input image **********************************************-->

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

                <button type="submit" class=" valider btn btn-primary"><i
                        class="fa-sharp fa-regular fa-circle-envelope"></i>Valider</button>

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
                    posté par {{ $post->user->pseudo }}
                    <div class="card-header row">
                        <img class="photo_user" src="{{ asset('images/' . $post->image) }} " alt="imagePost">
                        <div class="col-6">
                            {{ $post->tags }}
                        </div>
                        <div class="col-md-6">
                            posté il y a {{ $post->created_at->diffForHumans() }}
                        </div>
                    </div>

                    <div class="card-body">
                        <p>{{ $post->content }}</p>

                    </div>
                   
                </div>

                <!-- *************************************** Bouton modifier => mène à la page de modification du message ***********************************************-->
                <div class="row col-6">
                    {{-- @can('update', $post) --}}
                    <a href="{{ route('post.edit', $post) }}">
                        <button class="btn btn-info">Modifier</button>
                    </a>
                </div>
                {{-- @endcan --}}

                <!-- ********************************************************* Bouton supprimer **************************************************-->
                <div class="row col-6">
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

                <!-- ********************************************************* Ajout commentaires **************************************************-->
                
                {{-- @foreach ($comments as $comment)
                <form action="{{ route('post.store') }}" method="post" class="message w-75 mx-auto">
                    @csrf
                </form>
                @endforeach --}}

            @endforeach



            <!-- Pagination -->
            {{ $posts->links() }}
        </div>
    </div>
@endsection
