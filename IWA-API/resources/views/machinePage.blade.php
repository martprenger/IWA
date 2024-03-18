@extends('layouts.page')
@include('layouts.navbar')
@section('body')


    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-3">
                <h1>Machine ID's</h1>
                <h1>land</h1>
                <h1>Temperatuur</h1>
                <h1>Verbinding</h1>
                <h1>Storing</h1>
                <h1>instellingen</h1>
                <h1>verwijderen</h1>
            </div>
        </div>
    </div>

@foreach($machines as $machine)
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-3">
                <h1>{{$machine->station_name}}</h1>
                <h1>{{$machine->country}}</h1>

            </div>
        </div>
    </div>
@endforeach
