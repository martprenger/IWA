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



    <div class="container-md mt-3" >
            <form method="POST" action="{{ route('addemployee') }}">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Werknemer ID</label>
                    <input type="text" placeholder="ID" id="id" class="form-control"  aria-describedby="emailHelp" name="id" required autofocus>
                    @if ($errors->has('id'))
                        <span class="text-danger">{{ $errors->first('id') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Naam</label>
                    <input type="text" placeholder="Naam" id="id" class="form-control"  aria-describedby="emailHelp" name="name" required autofocus>
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
                <div class="mb-3">
                    <label for="worker_type" class="form-label">Type werknemer</label>
                    <select class="form-control" id="worker_type" name="worker_type" required>
                        <option value="">Type werknemer</option>
                        <option value="admin">Admin</option>
                        <option value="wetenschappelijk">Wetenschappelijk</option>
                        <option value="administratief">Administratief</option>
                    </select>
                    @if ($errors->has('worker_type'))
                        <span class="text-danger">{{ $errors->first('worker_type') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Wachtwoord</label>
                    <input  type="password" placeholder="Wachtwoord" id="password"class="form-control"  name="password" required>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div style="text-align: center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>

@endsection
