@extends ('layouts.app')

@section('content')
    <div class=container m-5 p-5 mx-auto>

        <div class ="text-center">
            <h1><span>Discutez, partager</span> de bons moments <span>sur</span> le réseau social <span>Funetwork</span> !</h1>
            <h2>Les collègues, ce n'est pas qu'au boulot!</h2>
        </div>

        <div class=" inscription-connexion row mt-5 w-50 mx-auto">
            <div class="col-6">
                <a href="register"><button class="Modif-Valid Ins-con btn btn-lg px-5">Inscription</button></a>
            </div>
            <div class="col-6">
                <a href="login"><button class="Modif-Valid Ins-con btn btn-lg px-5">Connexion</button></a>
            </div>
        </div>
        
@endsection

