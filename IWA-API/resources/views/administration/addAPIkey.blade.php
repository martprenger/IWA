@extends('layouts.page')
@include($navbar)

@section('body')


    <div>
        <div class="container-image">
            <img src="{{ asset('images/LogoIWA.jpg') }}" alt="">
        </div>
        <div class="container-md">
            <form method="POST" action="{{ route('addAPI') }}">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">klant nummer</label>
                    <input type="text" placeholder="klant nummer" id="klantenID" class="form-control"  aria-describedby="emailHelp" name="klantenID" required autofocus>
                    @if ($errors->has('klantenID'))
                        <span class="text-danger">{{ $errors->first('klantenID') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="actief" class="form-label">Status</label>
                    <select class="form-control" id="actief" name="actief" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    @if ($errors->has('actief'))
                        <span class="text-danger">{{ $errors->first('actief') }}</span>
                    @endif
                </div>


                <button type="submit" class="btn btn-primary">genereer API key</button>
            </form>
        </div>
@endsection
