@extends('layouts.page')

@section('body')

    <div>
        <div class="container-image">
            <img src="{{ asset('images/LogoIWA.jpg') }}" alt="">
        </div>
        <div class="container-md">
            <form method="POST" action="{{ route('login') }}">

                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Werknemer ID</label>
                    <input type="text" placeholder="ID" id="name" class="form-control" name="name" value="{{ old('name') }}"
                           required autocomplete="name" autofocus>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>


                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" placeholder="Password" id="password"
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
                        {{ __('Remember Me') }}
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
                <div>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>

@endsection
