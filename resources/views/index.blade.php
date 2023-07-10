<!--=================================== ACCUEIL ====================================-->


@extends ('layouts.app')

@section('content')
    <div class="container">

        <div class ="text-center accueil">
            <h1><span>Discutez, partager</span> de bons moments <span>sur</span> le réseau social <span>Funetwork</span> !</h1>
            <h2 class="p-5">Les collègues, ce n'est pas qu'au boulot!</h2>
        </div>

        <div class=" inscription-connexion row w-50 mx-auto">
            <div class="col-6 d-flex justify-content-center">
                <a href="register"><button class="Modif-Valid Ins-con btn btn-lg px-5">Inscription</button></a>
            </div>
            
            <div class="col-6 d-flex justify-content-center">
                <a href="login"><button class="Modif-Valid Ins-con btn btn-lg px-5">Connexion</button></a>
            </div>
        </div>

    </div>  
@endsection

