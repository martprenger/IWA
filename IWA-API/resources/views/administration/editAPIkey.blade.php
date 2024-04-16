@extends('layouts.page')
@include($navbar)

@section('body')

    <div>
        <div class="container-image">
            <img src="{{ asset('images/LogoIWA.jpg') }}" alt="">
        </div>
        <div class="container-md">
            <form method="POST" action="{{ route('editAPI') }}">
                @csrf
                <input type="hidden" name="id" value="{{$key->id}}">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">klant ID</label>
                    <input type="text" placeholder="ID" id="id" class="form-control"  aria-describedby="emailHelp" name="klantenID" value="{{$key->klantenID}}" required autofocus>
                    @if ($errors->has('klantenID'))
                        <span class="text-danger">{{ $errors->first('klantenID') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="newKey" class="form-label">generate new API key</label>
                    <select class="form-control" id="newKey" name="newKey" required>
                        <option value="0"> false</option>
                        <option value="1"> true</option>
                    </select>
                    @if ($errors->has('newKey'))
                        <span class="text-danger">{{ $errors->first('newKey') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="actief" class="form-label">Status</label>
                    <select class="form-control" id="actief" name="actief" required>
                        <option value="1" {{ $key->actief == "1" ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $key->actief == "0" ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @if ($errors->has('actief'))
                        <span class="text-danger">{{ $errors->first('actief') }}</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>



@endsection
