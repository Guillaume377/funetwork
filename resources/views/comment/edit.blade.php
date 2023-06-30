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


                <form class="col-4 mx-auto" action="{{ route('comment.update', $comment) }}" enctype="multipart/form-data" {{--enctype = pour UPLOAD--}} method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group p-3 w-100 text-center mx-auto">
                        <label for="message">Nouveau texte</label>
                        <input required type="text" class="form-control" placeholder="modifier" name="content"
                            value="{{ $comment->content }}" id="message">
                    </div>

                    <div class="form-group p-3 w-100 text-center mx-auto">
                        <label for="tags">Nouveau tags</label>
                        <input required type="text" class="form-control" placeholder="modifier" name="tags"
                            value="{{ $comment->tags }}" id="tags">
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