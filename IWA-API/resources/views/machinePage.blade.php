@extends('layouts.page')
@include('layouts.navbar')
@section('body')



    <div class="container text-center">
        <div class="row">
            <div class="col order-first">
                Machine ID's
            </div>
            <div class="col">
                land
            </div>
            <div class="col">
                Temperatuur
            </div>
            <div class="col">
                Verbinding
            </div>
            <div class="col">
                Storing
            </div>
            <div class="col">
                instellingen
            </div>
            <div class="col order-last">
                verwijderen
            </div>
        </div>
    </div>

@foreach($machines as $machine)
    <div class="container text-center">
        <div class="row">
            <div class="col order-first">
                {{ $machine->station_name}}
            </div>
            <div class="col">
                {{ $machine->country}}
            </div>
            <div class="col">
                ...........
            </div>
            <div class="col">
                ..........
            </div>
            <div class="col">
                ..........
            </div>
{{--            <div class="col">--}}
{{--                <a href="{{ route('machinePage', ['id' => $machine->id]) }}">instellingen</a>--}}
{{--            </div>--}}
{{--            <div class="col order-last">--}}
{{--                <a href="{{ route('deleteMachine', ['id' => $machine->id]) }}">verwijderen</a>--}}
{{--            </div>--}}
        </div>
    </div>

@endforeach
