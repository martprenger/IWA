@extends('layouts.page')
@include($navbar)

@section('body')
    <div>
        <div class="container-image">
            <img src="{{ asset('images/LogoIWA.jpg') }}" alt="">
        </div>
        <div class="container-md">
            <form method="POST" action="{{ route('editcustomerpost', ['customer' => $customer->id]) }}">
                @csrf
                <input type="hidden" name="original_id" value="{{$customer->id}}">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">naam</label>
                    <input type="text" placeholder="naam" id="id" class="form-control" value="{{ $customer->klantnaam }}" aria-describedby="emailHelp" name="klantnaam" required autofocus>
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">email</label>
                    <input type="text" placeholder="name@host.com" id="email" class="form-control" value="{{ $customer->email }}"  aria-describedby="emailHelp" name="email" required autofocus>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

@endsection
