<!--===================================MODIFIER MES INFORMATIONS - MON COMPTE====================================-->


@extends ('layouts.app')

@section('title')
    Mon compte
@endsection

@section('content')
    <main class="container">

        <h1 class="text-center m-5">Mon compte</h1>

        <h3 class="pb-3 text-center m-5">Modifier mes informations </h3>
        <div class="row mesinfos">

            <img class="photo_profil w-25" src="{{ asset('images/' . $user->image) }} " alt="image_utilisateur">
            <form class="col-4 mx-auto" action="{{ route('users.update', $user) }}" enctype="multipart/form-data"
                method="POST">
                @csrf
                @method('PUT')

                <div class="card-mesinfos p-3 rounded-3">
                    <div class="form-group">
                        <label for="pseudo">
                            <p>Nouveau pseudo
                            <p>
                        </label>
                        <input required type="text" class="form-control" placeholder="modifier" name="pseudo"
                            value="{{ $user->pseudo }}" id="pseudo">

                    </div>

                    <!-- ***************UPLOAD IMAGE*********** -->
                    <div class="form-group row">

                        <p class="m-0">{{ __('image (facultative)') }}</p>
                        <label for="image" class="col-form-label text-md-right"></label>

                        <div class="col-md-6">
                            <input type="file" name="image" class="upload form-control">
                        </div>
                    </div>


                    <!-- ********************** bouton valider ********************* -->
                    <button type="submit" class="Modif-Valid btn mt-2">Valider</button>
                </div>
            </form>


            <!-- ********************** bouton supprimer le compte ********************* -->
            <form class="d-flex justify-content-center ms-4" action="{{ route('users.destroy', $user) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="Supprimer mt-2 btn">supprimer le compte</button>
            </form>
        </div>


    </main>
@endsection
