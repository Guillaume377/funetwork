@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" {{--enctype = pour UPLOAD--}}>
                        @csrf

                        <!-- PSEUDO-->
                        <div class="row mb-3">
                            <label for="pseudo" class="col-md-4 col-form-label text-md-end">{{ __('pseudo') }}</label>

                            <div class="col-md-6">
                                <input id="pseudo" type="text" class="form-control @error('pseudo') is-invalid @enderror" name="pseudo" value="{{ old('pseudo') }}" required autocomplete="name" autofocus>

                                @error('pseudo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       <!-- ***************UPLOAD IMAGE*********** -->
                     <div class="form-group row">

                        <label for="image"
                        class=" facultative col-md-4 col-form-label text-md-right d-flex justify-content-end">{{ __('image (facultative)') }}</label>

                        <div class="col-md-6">
                            <input type="file" name="image" class="form-control">
                        </div>
                     </div>

                        <!--EMAIL-->
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end mt-3">{{ __('e-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control mt-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!--PASSWORD-->
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!--CONFIRMER PASSWORD-->
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('confirmez le mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <!--BOUTON VALIDER-->
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="Modif-Valid btn">
                                    {{ __('valider') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
