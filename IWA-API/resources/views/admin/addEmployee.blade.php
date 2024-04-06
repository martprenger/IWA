@include($navbar)
@extends('layouts.page')
@section('body')


    <div>
        <div class="container-image">
            <img src="{{ asset('images/LogoIWA.jpg') }}" alt="">
        </div>
        <div class="container-md">
            <form method="POST" action="{{ route('addemployee') }}">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">werknemer ID</label>
                    <input type="text" placeholder="ID" id="id" class="form-control"  aria-describedby="emailHelp" name="name" required autofocus>
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">email</label>
                    <input type="text" placeholder="name@host.com" id="email" class="form-control"  aria-describedby="emailHelp" name="email" required autofocus>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="worker_type" class="form-label">Worker Type</label>
                    <select class="form-control" id="worker_type" name="worker_type" required>
                        <option value="">Select Worker Type</option>
                        <option value="admin">Admin</option>
                        <option value="wetenschappelijk">Wetenschappelijk</option>
                        <option value="administratief">Administratief</option>
                    </select>
                    @if ($errors->has('worker_type'))
                        <span class="text-danger">{{ $errors->first('worker_type') }}</span>
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
