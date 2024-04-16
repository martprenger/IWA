@extends('layouts.page')
@include($navbar)

@section('body')
    <div class="container-fluid pl-0">
        <div class="col-md-12">
            <h3>Stations</h3>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Station Name</th>
                    <th>Country</th>
                    <th>Island</th>
                    <th>County</th>
                    <th>Place</th>
                    <th>Hamlet</th>
                    <th>Town</th>
                    <th>Municipality</th>
                    <th>State District</th>
                    <th>Administrative</th>
                    <th>State</th>
                    <th>Village</th>
                    <th>Region</th>
                    <th>Province</th>
                    <th>City</th>
                    <th>Locality</th>
                    <th><a href="{{ route('addstation') }}" class="btn btn-success">Add API key</a></th>
                </tr>
                </thead>

                <tbody>
                @foreach($geolocations as $geolocation)
                    <tr>
                        <td>{{ $geolocation->station_name }}</td>
                        <td>{{ $geolocation->countryName->country }}</td>
                        <td>{{ $geolocation->island }}</td>
                        <td>{{ $geolocation->county }}</td>
                        <td>{{ $geolocation->place }}</td>
                        <td>{{ $geolocation->hamlet }}</td>
                        <td>{{ $geolocation->town }}</td>
                        <td>{{ $geolocation->municipality }}</td>
                        <td>{{ $geolocation->state_district }}</td>
                        <td>{{ $geolocation->administrative }}</td>
                        <td>{{ $geolocation->state }}</td>
                        <td>{{ $geolocation->village }}</td>
                        <td>{{ $geolocation->region }}</td>
                        <td>{{ $geolocation->province }}</td>
                        <td>{{ $geolocation->city }}</td>
                        <td>{{ $geolocation->locality }}</td>
                        <td>
                            <!--TODO: make styling not use -15 px, i know this is bad but i hate front end-->
                            <div
                                style="display: flex; align-items: center; margin-bottom: -20px; margin-top: -20px;">
                                <a href="{{ route('editstations', ['name' => $geolocation->station_name]) }}"
                                   class="btn btn-primary" style="margin-right: 5px;">Edit</a>
                                <form method="POST" action="{{ route('deletestation') }}"
                                      style="margin-top: 4px; margin-left: -15px">
                                    @csrf
                                    <input type="hidden" name="name" value="{{ $geolocation->station_name }}">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="container">
        <form method="POST" action="{{ route('APIManagements') }}">
            @csrf
            <div class="row">
                <!-- Modify form fields as per Geolocation model attributes -->
                <div class="col-md-2">
                    <input type="text" name="station_name" class="form-control" placeholder="Station Name">
                </div>
                <div class="col-md-2">
                    <input type="text" name="country_code" class="form-control" placeholder="Country Code">
                </div>
                <div class="col-md-2">
                    <input type="text" name="island" class="form-control" placeholder="Island">
                </div>
                <div class="col-md-2">
                    <input type="text" name="county" class="form-control" placeholder="County">
                </div>
                <div class="col-md-2">
                    <input type="text" name="place" class="form-control" placeholder="Place">
                </div>
                <div class="col-md-2">
                    <input type="text" name="hamlet" class="form-control" placeholder="Hamlet">
                </div>
                <div class="col-md-2">
                    <input type="text" name="town" class="form-control" placeholder="Town">
                </div>
                <div class="col-md-2">
                    <input type="text" name="municipality" class="form-control" placeholder="Municipality">
                </div>
                <div class="col-md-2">
                    <input type="text" name="state_district" class="form-control" placeholder="State District">
                </div>
                <div class="col-md-2">
                    <input type="text" name="administrative" class="form-control" placeholder="Administrative">
                </div>
                <div class="col-md-2">
                    <input type="text" name="state" class="form-control" placeholder="State">
                </div>
                <div class="col-md-2">
                    <input type="text" name="village" class="form-control" placeholder="Village">
                </div>
                <div class="col-md-2">
                    <input type="text" name="region" class="form-control" placeholder="Region">
                </div>
                <div class="col-md-2">
                    <input type="text" name="province" class="form-control" placeholder="Province">
                </div>
                <div class="col-md-2">
                    <input type="text" name="city" class="form-control" placeholder="City">
                </div>
                <div class="col-md-2">
                    <input type="text" name="locality" class="form-control" placeholder="Locality">
                </div>
                <!-- Add other relevant form fields -->
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
    </div>
@endsection
