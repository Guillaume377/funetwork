@extends ('layouts.app')

@section('title')
    Mon compte
@endsection

@section('content')
    <main class="container">
        <div class="row d-flex justify-content-center text-center">

            <h1 class="m-5">Mon commentaire</h1>

            <h3 class="pb-3 m-5">Modifier mon commentaire </h3>
            <div class="row modifpost">


                <form class="col-4 mx-auto" action="{{ route('comment.update', $comment) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group p-3">
                        <label for="message">Nouveau texte</label>
                        <input required type="text" class="form-control" placeholder="modifier" name="content"
                            value="{{ $comment->content }}" id="message">
                    </div>

                    <div class="form-group p-3">
                        <label for="tags">Nouveau tags</label>
                        <input required type="text" class="form-control" placeholder="modifier" name="tags"
                            value="{{ $comment->tags }}" id="tags">
                    </div>

                    <div class="form-group p-3">
                        <label for="image">Nouvelle image</label>
                        <input required type="text" class="form-control" placeholder="modifier" name="image"
                            value="{{ $comment->image }}" id="image">
                    </div>


                    <!-- ********************** bouton valider ********************* -->
                    <button type="submit" class="validermodif btn btn-primary">Valider</button>
                </form>

            </div>
        </div>
    </main>
@endsection