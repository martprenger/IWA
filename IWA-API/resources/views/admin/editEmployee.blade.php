@extends('layouts.page')
@include($navbar)
@section('body')

{{--edit emplyee page--}}
<style>
    body {
        background-image: url('{{ asset('images/loginwallpaper.jpg') }}');
        background-size: cover;
        background-repeat: no-repeat;
    }
</style>



<div class="container-md mt-3">
        <form method="POST" action="{{ route('editemployee') }}">
            @csrf
            <input type="hidden" name="original_id" value="{{$employee->id}}">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Werknemer ID</label>
                <input type="text" placeholder="ID" id="id" class="form-control"  aria-describedby="emailHelp" name="id" value="{{$employee->id}}" required autofocus>
                @if ($errors->has('id'))
                    <span class="text-danger">{{ $errors->first('id') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="exampleInputName1" class="form-label">Naam</label>
                <input type="text" placeholder="Naam" id="name" class="form-control"  aria-describedby="nameHelp" name="name" value="{{$employee->name}}" required autofocus>
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="worker_type" class="form-label">Type werknemer</label>
                <select class="form-control" id="worker_type" name="worker_type" required>
                    <option value="">Type werknemer</option>
                    <option value="admin" {{ $employee->worker_type == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="wetenschappelijk" {{ $employee->worker_type == 'wetenschappelijk' ? 'selected' : '' }}>Wetenschappelijk</option>
                    <option value="administratief" {{ $employee->worker_type == 'administratief' ? 'selected' : '' }}>Administratief</option>
                </select>
                @if ($errors->has('worker_type'))
                    <span class="text-danger">{{ $errors->first('worker_type') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="text" placeholder="Email" id="email" class="form-control"  aria-describedby="emailHelp" name="email" value="{{$employee->email}}" required autofocus>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div style="text-align: center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

@endsection
