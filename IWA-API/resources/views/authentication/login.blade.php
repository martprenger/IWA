@extends('layouts.page')

@section('body')

<div>
    <div class="container-image">
        <img src="{{ asset('images/LogoIWA.jpg') }}" alt="">
    </div>
    <div class="container-md">
        <form method="POST" action="{{ route('custom-login') }}">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">werknemer ID</label>
                <input type="text" placeholder="name" id="name" class="form-control"  aria-describedby="emailHelp" name="name" required autofocus>
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input  type="password" placeholder="Password" id="password"class="form-control"  name="password" required>
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection




