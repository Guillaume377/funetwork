<!--===================================MODIFIER POST====================================-->


@extends ('layouts.app')

@section('title')
    Mon compte
@endsection

@section('content')
    <main class="container">
        <div class="row d-flex justify-content-center text-center">

            <div class="container titre">
                <h1 class="py-3 m-5">Mon post</h1>
            </div>

            <div class="container titre">
                <h3 class="py-3 m-5">Modifier mon post </h3>
            </div>

                <div class="row modifpost">

                    <form class="col-4 mx-auto" action="{{ route('post.update', $post) }}" enctype="multipart/form-data"
                        {{-- enctype = pour UPLOAD --}} method="POST">
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

                        <!-- ***************UPLOAD IMAGE*********** -->
                        <div class="form-group">

                            <label for="image"
                                class="col-md-4 col-form-label text-md-right">{{ __('image (facultative)') }}</label>

                            <div class="col-md-6">
                                <input type="file" name="image" class="upload form-control">
                            </div>
                        </div>


                        <!-- ********************** bouton valider ********************* -->
                        <button type="submit" class="Modif-Valid btn m-2">Valider</button>
                    </form>

                </div>
            </div>
    </main>
@endsection
