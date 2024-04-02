@extends('layouts.page')
@include('layouts.navbar')
@section('body')

<div class="container mt-3">
    <div class="row justify-content-center">
        <h1 class="text-center">Weerstation toevoegen:</h2>
        <div class="col-md-10">
            <form action="{{ route('add-station') }}" method="POST">
                @csrf
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-5 m-3 p-3 card bg-iwa-grey">
                            <div class="text-center">
                                <h2>Naam:</h2>
                                <input type="text" class="form-control" name="station[name]">
                            </div>
                        </div>
                        <div class="col-md-5 m-3 p-3 card bg-iwa-grey" >
                            <div class="text-center">
                                <h2>Elevation:</h2>
                                <input type="text" class="form-control" name="station[elevation]">
                            </div>
                        </div>
                        <div class="col-md-5 m-3 p-3 card bg-iwa-grey">
                            <div class="text-center">
                                <h2>Longitude:</h2>
                                <input type="text" class="form-control" name="station[longitude]">
                            </div>
                        </div>
                        <div class="col-md-5 m-3 p-3 card bg-iwa-grey">
                            <div class="text-center">
                                <h2>Latitude:</h2>
                                <input type="text" class="form-control" name="station[latitude]">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fixed-bottom">
                    <div class="w-100 bg-iwa-blue">
                        <div class="text-end">
                            <button type="submit" class="btn btn-light m-3">Opslaan</button>
                        </div>
                    </div>
                </div>
            </form>
    </div>
</div>

@endsection