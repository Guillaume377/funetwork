@extends ('layouts.app')

@section('content')
    <div class=container m-5 p-5 mx-auto>

        <div class ="text-center">
            <h1>Bienvenue sur le réseau social Laravel !</h1>
        </div>

        <div class="row mt-5 w-50 mx-auto">
            <div class="col-6">
                <a href="register"><button class="btn btn-lg px-5 btn-primary">Inscription</button></a>
            </div>
            <div class="col-6">
                <a href="login"><button class="btn btn-lg px-5 btn-primary">Inscription</button></a>
            </div>
        </div>
        
@endsection

