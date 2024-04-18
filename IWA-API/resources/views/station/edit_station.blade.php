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

{{--edit station page--}}
    <div class="container-md" style="margin-bottom: 40px; margin-top:20px;">
        <form method="POST" action="{{ route('editstation') }}">
            @csrf
            <input type="hidden" name="old_name" value="{{$station->name}}">
            <div class="mb-3">
                <label for="name" class="form-label">Station Name</label>
                <input type="text" placeholder="Name" id="name" class="form-control" name="name" value="{{$station->name}}" required autofocus>
                @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="elevation" class="form-label">Elevation</label>
                <input type="text" placeholder="Elevation" id="elevation" class="form-control" name="elevation" value="{{$station->elevation}}" required>
                @if ($errors->has('elevation'))
                <span class="text-danger">{{ $errors->first('elevation') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="longitude" class="form-label">Longitude</label>
                <input type="text" placeholder="Longitude" id="longitude" class="form-control" name="longitude" value="{{$station->longitude}}" required>
                @if ($errors->has('longitude'))
                <span class="text-danger">{{ $errors->first('longitude') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="latitude" class="form-label">Latitude</label>
                <input type="text" placeholder="Latitude" id="latitude" class="form-control" name="latitude" value="{{$station->latitude}}" required>
                @if ($errors->has('latitude'))
                <span class="text-danger">{{ $errors->first('latitude') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="country_code" class="form-label">Country Code</label>
                <input type="text" placeholder="Country Code" id="country_code" class="form-control" name="country_code" value="{{$geolocation->country_code}}" required>
                @if ($errors->has('country_code'))
                <span class="text-danger">{{ $errors->first('country_code') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="island" class="form-label">Island</label>
                <input type="text" class="form-control" id="island" placeholder="Island" name="island" value="{{$geolocation->island}}">
                @error('island')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="county" class="form-label">County</label>
                <input type="text" class="form-control" id="county" placeholder="County" name="county" value="{{$geolocation->county}}">
                @error('county')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="place" class="form-label">Place</label>
                <input type="text" class="form-control" id="place" placeholder="Place" name="place" value="{{$geolocation->place}}">
                @error('place')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="hamlet" class="form-label">Hamlet</label>
                <input type="text" class="form-control" id="hamlet" placeholder="Hamlet" name="hamlet" value="{{$geolocation->hamlet}}">
                @error('hamlet')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="town" class="form-label">Town</label>
                <input type="text" class="form-control" id="town" placeholder="Town" name="town" value="{{$geolocation->town}}">
                @error('town')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="municipality" class="form-label">Municipality</label>
                <input type="text" class="form-control" id="municipality" placeholder="Municipality" name="municipality" value="{{$geolocation->municipality}}">
                @error('municipality')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="state_district" class="form-label">State District</label>
                <input type="text" class="form-control" id="state_district" placeholder="State District" name="state_district" value="{{$geolocation->state_district}}">
                @error('state_district')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="administrative" class="form-label">Administrative</label>
                <input type="text" class="form-control" id="administrative" placeholder="Administrative" name="administrative" value="{{$geolocation->administrative}}">
                @error('administrative')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="state" class="form-label">State</label>
                <input type="text" class="form-control" id="state" placeholder="State" name="state" value="{{$geolocation->state}}">
                @error('state')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="village" class="form-label">Village</label>
                <input type="text" class="form-control" id="village" placeholder="Village" name="village" value="{{$geolocation->village}}">
                @error('village')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="region" class="form-label">Region</label>
                <input type="text" class="form-control" id="region" placeholder="Region" name="region" value="{{$geolocation->region}}">
                @error('region')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="province" class="form-label">Province</label>
                <input type="text" class="form-control" id="province" placeholder="Province" name="province" value="{{$geolocation->province}}">
                @error('province')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" placeholder="City" name="city" value="{{$geolocation->city}}">
                @error('city')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="locality" class="form-label">Locality</label>
                <input type="text" class="form-control" id="locality" placeholder="Locality" name="locality" value="{{$geolocation->locality}}">
                @error('locality')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="postcode" class="form-label">Postcode</label>
                <input type="text" class="form-control" id="postcode" placeholder="Postcode" name="postcode" value="{{$geolocation->postcode}}">
                @error('postcode')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="localcountryname" class="form-label">Local Country Name</label>
                <input type="text" class="form-control" id="localcountryname" placeholder="Local Country Name" name="localcountryname" value="{{$geolocation->localcountryname}}">
                @error('localcountryname')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!-- Add other fields in a similar manner -->
            <div style="text-align: center">
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
