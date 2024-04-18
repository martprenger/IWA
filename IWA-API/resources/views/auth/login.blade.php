@extends('layouts.page')

@section('body')
    <style>
        body {
            background-image: url('{{ asset('images/loginwallpaper.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>

    <div>
        <div class="container-image" style="text-align: center; mix-blend-mode: multiply">
            <img src="{{ asset('images/LogoIWA.jpg') }}" alt="">
        </div>
        <div class="container-md">
            <form method="POST" action="{{ route('login') }}">

                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Werknemer ID</label>
                    <input type="text" placeholder="ID" id="id" class="form-control" name="id" value="{{ old('id') }}"
                           required autocomplete="name" autofocus>
                    @if ($errors->has('id'))
                        <span class="text-danger">{{ $errors->first('id') }}</span>
                    @endif
                </div>


                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Wachtwoord</label>
                    <input type="password" placeholder="Wachtwoord" id="password"
                           class="form-control @error('password') is-invalid @enderror" name="password" required
                           autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember"
                           id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Onthoud mij') }}
                    </label>
                </div>
                <div style="text-align: center">
                <button type="submit" class="btn btn-primary" >Login</button>
                </div>
                <!-- wachtwoord vergeten, momenteel nog niet werkende
                <div style="text-align: center">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Wachtwoord vergeten?') }}
                        </a>
                    @endif
                </div>
                -->
            </form>
        </div>

@endsection
