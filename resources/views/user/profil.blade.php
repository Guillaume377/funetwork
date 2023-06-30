@extends ('layouts.app')

@section('title')
    Profil de {{ $user->pseudo }}
@endsection

@section('content')
    <div class="container mb-3">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="container-fluid text-center p-3">
                    <div class="col">
                        @if ($user->image)
                            <img src="{{ asset("images/$user->image") }} " class="m-1 rounded-circle"
                                style="width: 20vw; height:20vw" alt="imageUtilisateur">
                        @else
                            <img src="{{ asset('images/default_user.jpg') }} " class="m-1 rounded-circle"
                                style="width: 20vw; height:20vw" alt="imageUtilisateur">
                        @endif
                    </div>
                    <div class="col pt-3">
                        <p class=bienvenue>Bienvenue sur le profil de
                        </p>
                        <h1 class="font-weight-bold text-warning">
                            {{ $user->pseudo }}</h1>
                    </div>

                    <div class="container w-50">

                        <div class="row p-2 justify-content-between">
                            <div class="col-6">
                                <i class="fas fa-arrow-alt-circle-right fa-2x text-primary"></i>
                            </div>
                            <div class="col-6">
                                <p> inscrit(e) le {{ date('d-m-Y à H:i:s', strtotime($user->created_at)) }}</p>
                            </div>
                        </div>

                        <div class="row p-2 justify-content-center">
                            <div class="col-6">
                                <i class="fas fa-comments fa-2x text-primary"></i>
                            </div>
                            <div class="col-6">
                                <p> {{ count($user->posts) }} post(s) posté(s)</p>
                            </div>
                        </div>

                    </div>
                    <!-- ***********************************AFFICHER LES POSTS*****************************-->

                    @foreach ($user->posts as $post)
                        <div class="card text-bg-primary mb-4 mt-5 pb-2">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col">
                                        @if ($user->image)
                                            <img class="m-1 rounded-circle" style="width: 5vw; height:5vw"
                                                src="{{ asset("images/$user->image") }}" alt="imageUtilisateur">
                                        @else
                                            <img class="m-1 rounded-circle" style="width: 5vw; height:5vw"
                                                src="{{ asset('images/default_user.jpg') }}" alt="imageUtilisateur">
                                        @endif
                                        <h5><a href="{{ route('users.show', $post->user_id) }}">
                                                <strong>{{ $user->pseudo }}</strong>
                                            </a>
                                        </h5>
                                    </div>

                                    <div class="col m-auto">
                                        <h4>#{{ $post->tags }} </h4>
                                    </div>
                                    <div class="col m-auto">
                                        <div class="row">posté {{ $post->created_at->diffForHumans() }}</div>
                                        @if ($post->created_at != $post->updated_at)
                                            <div class="row">modifié {{ $post->updated_at->diffForHumans() }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if ($post->image !== null)
                                <div class="card-img p-3">
                                    <img class="m-1" style="width: 45vw" src="{{ asset("images/$post->image") }}"
                                        alt="imagePost">
                                </div>
                            @endif
                            <div class="card-body ml-5 mr-5">
                                <p>{{ $post->content }}</p>



                                <!--  ******************************OPTIONS : MASQUER, COMMENTER, MODIFIER, SUPPRIMER******************   -->
                                <div class="row mt-2">
                                    <div class="col"><a class="Commenter btn"
                                            onclick="document.getElementById('formulairecommentaire{{ $post->id }}').style.display = 'block'">Commenter
                                        </a>
                                    </div>
                                    <!-- si l'utilisateur connecté a posté le post, il peut le modifier et le supprimer-->
                                    <div class="col">
                                        @can('update', $post)
                                            <a href="{{ route('post.edit', $post) }}">
                                                <button class="Modif-Valid btn">Modifier</button>
                                            </a>
                                        @endcan
                                    </div>
                                    <div class="col">
                                        <form action="{{ route('post.destroy', $post) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="Supprimer btn">Supprimer</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- **********************************************AJOUTER UN COMMENTAIRE**********************************************-->
                        <form style="display:none;" id="formulairecommentaire{{ $post->id }}"
                            class="col-12 mx-auto mb-2" action="{{ route('comment.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="content">Tapez votre message</label>
                                <textarea required class="container-fluid" type="text" name="content" id="content"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-4"></div>
                                <div class="col-4 form-group">
                                    <label for="nom">image (facultatif)</label>
                                    <input type="text" class="form-control" name="image" id="image">
                                </div>
                                <input class="form-control" type="hidden" id="quack_id" name="quack_id"
                                    value="{{ $post->id }}">
                            </div>
                            <button class="btn btn-danger"
                                onclick="document.getElementById('formulairecommentaire{{ $post->id }}').style.display = 'none'">
                                Annuler
                            </button>
                            <button type="submit" class="btn btn-warning">Valider</button>
                        </form>


                        <!-- ********************************************* AFFICHER LES COMMENTAIRES **********************************************-->

                        @foreach ($post->comments as $comment)
                            <div class="card-commentaire w-75 mb-3">
                                <div class="card-header row">
                                    <div class="d-flex flex-column align-items-center col-4">
                                        @if ($comment->user->image)
                                            <img class="photo_user" src="images/{{ $comment->user->image }} "
                                                alt="imagePost">
                                        @endif
                                        posté par {{ $comment->user->pseudo }}
                                    </div>

                                    <div class="col-4">
                                        <h4>#{{ implode(' #', explode(' ', $comment->tags)) }} </h4>
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
                                    <img class="photo_commentaire mb-3" src="images/{{ $comment->image }} "
                                        alt="image du commentaire">
                                </div>



                                <!-- *************************************** Bouton modifier => mène à la page de modification du commentaire ***********************************************-->
                                <div class="row">
                                    <div class="col-6">
                                        {{-- @can('fonction de CommentPolicy.php, class Post de AuthServiceProvider.php') --}}
                                        @can('update', $comment)
                                            <a href="{{ route('comment.edit', $comment) }}">
                                                <button class="Modif-Valid btn mb-3">Modifier</button>
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
                                                    <button type="submit" class="Supprimer btn mb-3">Supprimer</button>
                                                </form>
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
