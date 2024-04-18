@extends('layouts.page')
@include($navbar)

@section('body')
    <style>
        body {
            background-image: url('{{ asset('images/loginwallpaper.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
    <div class="container-md" style="position: absolute; top: 55%; left: 50%; transform: translate(-50%, -50%);">
            <form method="POST" action="{{ route('addcustomer') }}">
                @csrf

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Naam</label>
                    <input type="text" placeholder="Naam" id="id" class="form-control"  aria-describedby="emailHelp" name="klantnaam" required autofocus>
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="text" placeholder="Email" id="email" class="form-control"  aria-describedby="emailHelp" name="email" required autofocus>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

@endsection
