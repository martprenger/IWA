@extends('layouts.page')
@include($navbar)

@section('body')
    <div class="container-image">
        <img src="{{ asset('images/LogoIWA.jpg') }}" alt="">
    </div>
    <div class="container-md">
        <form method="POST" action="{{ route('addstation') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Station Name</label>
                <input type="text" class="form-control" id="name" placeholder="Station Name" name="name" required autofocus>
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="elevation" class="form-label">Elevation</label>
                <input type="text" class="form-control" id="elevation" placeholder="Elevation" name="elevation" required>
                @error('elevation')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="longitude" class="form-label">Longitude</label>
                <input type="text" class="form-control" id="longitude" placeholder="Longitude" name="longitude" required>
                @error('longitude')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="latitude" class="form-label">Latitude</label>
                <input type="text" class="form-control" id="latitude" placeholder="Latitude" name="latitude" required>
                @error('latitude')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="country_code" class="form-label">Country Code</label>
                <input type="text" class="form-control" id="country_code" placeholder="Country Code" name="country_code" required>
                @error('country_code')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="island" class="form-label">Island</label>
                <input type="text" class="form-control" id="island" placeholder="Island" name="island">
                @error('island')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="county" class="form-label">County</label>
                <input type="text" class="form-control" id="county" placeholder="County" name="county">
                @error('county')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="place" class="form-label">Place</label>
                <input type="text" class="form-control" id="place" placeholder="Place" name="place">
                @error('place')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="hamlet" class="form-label">Hamlet</label>
                <input type="text" class="form-control" id="hamlet" placeholder="Hamlet" name="hamlet">
                @error('hamlet')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="town" class="form-label">Town</label>
                <input type="text" class="form-control" id="town" placeholder="Town" name="town">
                @error('town')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="municipality" class="form-label">Municipality</label>
                <input type="text" class="form-control" id="municipality" placeholder="Municipality" name="municipality">
                @error('municipality')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="state_district" class="form-label">State District</label>
                <input type="text" class="form-control" id="state_district" placeholder="State District" name="state_district">
                @error('state_district')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="administrative" class="form-label">Administrative</label>
                <input type="text" class="form-control" id="administrative" placeholder="Administrative" name="administrative">
                @error('administrative')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="state" class="form-label">State</label>
                <input type="text" class="form-control" id="state" placeholder="State" name="state">
                @error('state')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="village" class="form-label">Village</label>
                <input type="text" class="form-control" id="village" placeholder="Village" name="village">
                @error('village')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="region" class="form-label">Region</label>
                <input type="text" class="form-control" id="region" placeholder="Region" name="region">
                @error('region')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="province" class="form-label">Province</label>
                <input type="text" class="form-control" id="province" placeholder="Province" name="province">
                @error('province')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" placeholder="City" name="city">
                @error('city')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="locality" class="form-label">Locality</label>
                <input type="text" class="form-control" id="locality" placeholder="Locality" name="locality">
                @error('locality')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="postcode" class="form-label">Postcode</label>
                <input type="text" class="form-control" id="postcode" placeholder="Postcode" name="postcode">
                @error('postcode')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="localcountryname" class="form-label">Local Country Name</label>
                <input type="text" class="form-control" id="localcountryname" placeholder="Local Country Name" name="localcountryname">
                @error('localcountryname')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!-- Include other fields in a similar manner -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
