@extends ('layouts.app')

@section('title')
    Mon compte
@endsection

@section('content')
    <main class="container">
        <div class="row d-flex justify-content-center text-center">

            <h1 class="m-5">Mon post</h1>

            <h3 class="pb-3 m-5">Modifier mon post </h3>
            <div class="row modifpost">


                <form class="col-4 mx-auto" action="{{ route('post.update', $post) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group p-3">
                        <label for="message">Nouveau texte</label>
                        <input required type="text" class="form-control" placeholder="modifier" name="content"
                            value="{{ $post->content }}" id="message">
                    </div>

                    <div class="form-group p-3">
                        <label for="tags">Nouveau tags</label>
                        <input required type="text" class="form-control" placeholder="modifier" name="tags"
                            value="{{ $post->tags }}" id="tags">
                    </div>

                    <div class="form-group p-3">
                        <label for="image">Nouvelle image</label>
                        <input required type="text" class="form-control" placeholder="modifier" name="image"
                            value="{{ $post->image }}" id="image">
                    </div>


                    <!-- ********************** bouton valider ********************* -->
                    <button type="submit" class="Modif-Valid btn">Valider</button>
                </form>

            </div>
        </div>
    </main>
@endsection
