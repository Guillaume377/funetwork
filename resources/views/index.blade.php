@extends ('layouts.app')

@section('content')
    <div class=container m-5 p-5 mx-auto>

        <div class ="text-center">
            <h1>DIscutez, partager de bons moments sur le réseau social Funetwork !</h1>
            <h2>Les collègues, ce n'est pas qu'au boulot!</h2>
        </div>

        <div class="row mt-5 w-50 mx-auto">
            <div class="col-6">
                <a href="register"><button class="btn btn-lg px-5 btn-primary">Inscription</button></a>
            </div>
            <div class="col-6">
                <a href="login"><button class="btn btn-lg px-5 btn-primary">Connexion</button></a>
            </div>
        </div>
        
@endsection

