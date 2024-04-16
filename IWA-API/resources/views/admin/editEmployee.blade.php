@extends('layouts.page')
@include($navbar)
@section('body')

{{--edit emplyee page--}}
<div>
    <div class="container-image">
        <img src="{{ asset('images/LogoIWA.jpg') }}" alt="">
    </div>
    <div class="container-md">
        <form method="POST" action="{{ route('editemployee') }}">
            @csrf
            <input type="hidden" name="original_id" value="{{$employee->id}}">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">werknemer ID</label>
                <input type="text" placeholder="ID" id="id" class="form-control"  aria-describedby="emailHelp" name="id" value="{{$employee->id}}" required autofocus>
                @if ($errors->has('id'))
                    <span class="text-danger">{{ $errors->first('id') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="exampleInputName1" class="form-label">name</label>
                <input type="text" placeholder="name" id="name" class="form-control"  aria-describedby="nameHelp" name="name" value="{{$employee->name}}" required autofocus>
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="worker_type" class="form-label">Worker Type</label>
                <select class="form-control" id="worker_type" name="worker_type" required>
                    <option value="">Select Worker Type</option>
                    <option value="admin" {{ $employee->worker_type == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="wetenschappelijk" {{ $employee->worker_type == 'wetenschappelijk' ? 'selected' : '' }}>Wetenschappelijk</option>
                    <option value="administratief" {{ $employee->worker_type == 'administratief' ? 'selected' : '' }}>Administratief</option>
                </select>
                @if ($errors->has('worker_type'))
                    <span class="text-danger">{{ $errors->first('worker_type') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">email</label>
                <input type="text" placeholder="email" id="email" class="form-control"  aria-describedby="emailHelp" name="email" value="{{$employee->email}}" required autofocus>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
