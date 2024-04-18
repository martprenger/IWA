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

    <div class="container-md" style="margin-bottom: 40px; margin-top:20px;">
            <form method="POST" action="{{ route('addAPI') }}">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Klantnummer</label>
                    <input type="text" placeholder="Klantnummer" id="klantenID" class="form-control"  aria-describedby="emailHelp" name="klantenID" required autofocus>
                    @if ($errors->has('klantenID'))
                        <span class="text-danger">{{ $errors->first('klantenID') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="actief" class="form-label">Status</label>
                    <select class="form-control" id="actief" name="actief" required>
                        <option value="1">Actief</option>
                        <option value="0">Inactief</option>
                    </select>
                    @if ($errors->has('actief'))
                        <span class="text-danger">{{ $errors->first('actief') }}</span>
                    @endif
                </div>


                <button type="submit" class="btn btn-primary">Genereer API key</button>
            </form>
        </div>
@endsection
