@extends('layouts.page')
@include($navbar)
@section('body')

    <div class="bottom-navbar" style="position: fixed; bottom: 0; width: 100%;">
        <nav class="navbar navbar-expand-lg navbar-light bg-rgba" style="background-color: rgba(77, 153, 231, 1);">
            <!-- Left Side Of Navbar -->
            <div class="navbar-brand" style="margin-left: 35px;">
                <a href="{{ route('addstation') }}"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="rgba(173, 255, 47, 1)" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                    </svg></a>

            </div>
            <!-- Center Side Of Navbar -->
            <div class="mx-auto order-0">
                <div class="pagination-links d-flex justify-content-center mt-5" style="margin-bottom: 30px; margin-left: 15px">
                    <ul class="pagination">
                        {{-- Previous Page Link --}}
                        @if ($geolocations->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">&laquo;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $geolocations->previousPageUrl() }}" rel="prev">&laquo;</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @if ($geolocations->lastPage() > 0)
                            @php
                                $startPage = max($geolocations->currentPage() - 2, 1);
                                $endPage = min($startPage + 4, $geolocations->lastPage());
                            @endphp
                            @for ($page = $startPage; $page <= $endPage; $page++)
                                @if ($page == $geolocations->currentPage())
                                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $geolocations->url($page) }}">{{ $page }}</a></li>
                                @endif
                            @endfor
                        @endif

                        {{-- Next Page Link --}}
                        @if ($geolocations->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $geolocations->nextPageUrl() }}" rel="next">&raquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">&raquo;</span>
                            </li>
                        @endif

                    </ul>
                </div>
            </div>


            <!-- Hier kan nog iets komen -->
            <!-- Right Side Of Navbar -->
            <div>
                <div class="ml-auto " style="margin-top:10px; margin-right: -85px; margin-left: 20px;">
                    <form method="POST" action="{{ route('station') }}">
                        @csrf
                        <div class="row justify-content-end">
                            <!-- Modify form fields as per Geolocation model attributes -->
                            <div class="col">
                                <input type="text" name="station_name" class="form-control" placeholder="Station name">
                            </div>
                            <div class="col">
                                <input type="text" name="country" class="form-control" placeholder="Country">
                            </div>
                            <!--
                            <div class="col-md-1">
                                <input type="text" name="island" class="form-control" placeholder="Island">
                            </div>
                            -->
                            <div class="col">
                                <input type="text" name="county" class="form-control" placeholder="County">
                            </div>
                            <!-- <div class="col">
                                <input type="text" name="place" class="form-control" placeholder="Place">
                            </div>

                            <div class="col-md-1">
                                <input type="text" name="hamlet" class="form-control" placeholder="Hamlet">
                            </div>-->
{{--                            <div class="col">--}}
{{--                                <input type="text" name="town" class="form-control" placeholder="Town">--}}
{{--                            </div>--}}
                            <div class="col" >
                                <input type="text" name="municipality" class="form-control" placeholder="Municipality">
                            </div>
                            <div class="col">
                                <input type="text" name="state_district" class="form-control" placeholder="State District">
                            </div>
                            <!--
                            <div class="col-md-1">
                                <input type="text" name="administrative" class="form-control" placeholder="Administrative">
                            </div>
                            -->
                            <div class="col">
                                <input type="text" name="state" class="form-control" placeholder="State">
                            </div>
{{--                            <div class="col">--}}
{{--                                <input type="text" name="village" class="form-control" placeholder="Village">--}}
{{--                            </div>--}}
                            <div class="col">
                                <input type="text" name="region" class="form-control" placeholder="Region">
                            </div>
                            <!--
                            <div class="col-md-2">
                                <input type="text" name="province" class="form-control" placeholder="Province">
                            </div>

                            <div class="col-md-2">
                                <input type="text" name="city" class="form-control" placeholder="City">
                            </div>

                            <div class="col-md-2">
                                <input type="text" name="locality" class="form-control" placeholder="Locality">
                            </div>
                            -->
                            <!-- Add other relevant form fields -->
                            <div class="col">
                                <button type="submit" class="btn" style="background-color:rgba(173, 255, 47, 1)"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="22" fill="black)" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                    </svg></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
    </div>


    <!-- grote page navigatie
    <div class="pagination-links d-flex justify-content-center mt-5" style="margin-bottom: 200px;">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($geolocations->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">&laquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $geolocations->previousPageUrl() }}" rel="prev">&laquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @if ($geolocations->currentPage() <= 10)
                @for ($page = 1; $page <= min(10, $geolocations->lastPage()); $page++)
                    @if ($page == $geolocations->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $geolocations->url($page) }}">{{ $page }}</a></li>
                    @endif
                @endfor
            @else
                {{-- If current page is greater than 10 --}}
                @for ($page = $geolocations->currentPage() - 4; $page <= $geolocations->currentPage() + 5; $page++)
                    @if ($page == $geolocations->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $geolocations->url($page) }}">{{ $page }}</a></li>
                    @endif
                @endfor
            @endif
            {{-- Next Page Link --}}
            @if ($geolocations->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $geolocations->nextPageUrl() }}" rel="next">&raquo;</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">&raquo;</span>
                </li>
            @endif

        </ul>
    </div>
    -->

    <div class="container-fluid pl-0">
        <div class="col-md-12" style="margin-bottom: 90px">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Stationname</th>
                    <th>Country</th>
                    <!--<th>Island</th>-->
                    <th>County</th>
                    <!--<th>Place</th>-->
                    <!--<th>Hamlet</th>-->
                    <th>Town</th>
                    <th>Municipality</th>
                    <th>State District</th>
                    <!--<th>Administrative</th>-->
                    <th>State</th>
                    <th>Village</th>
                    <th>Region</th>
                    <!--<th>Province</th>-->
                    <th>City</th>
                    <!--<th>Locality</th>-->

                </tr>
                </thead>

                <tbody>
                @foreach($geolocations as $geolocation)
                    <tr>
                        <td>{{ $geolocation->station_name }}</td>
                        <td>{{ $geolocation->countryName->country }}</td>
                        <td>{{ $geolocation->county }}</td>
                        <td>{{ $geolocation->town }}</td>
                        <td>{{ $geolocation->municipality }}</td>
                        <td>{{ $geolocation->state_district }}</td>
                        <td>{{ $geolocation->state }}</td>
                        <td>{{ $geolocation->village }}</td>
                        <td>{{ $geolocation->region }}</td>
                        <td>{{ $geolocation->city }}</td>

                        <td>
                            <!--TODO: make styling not use -15 px, i know this is bad but i hate front end-->
                            <div
                                style="display: flex; align-items: center; margin-bottom: -20px; margin-top: -20px;">
                                <a href="{{ route('editstations', ['name' => $geolocation->station_name]) }}"
                                   class="btn btn-primary" style="margin-right: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                    </svg></a>
                                <form method="POST" action="{{ route('deletestation') }}"
                                      style="margin-top: 4px; margin-left: -15px">
                                    @csrf
                                    <input type="hidden" name="name" value="{{ $geolocation->station_name }}">
                                    <button type="submit" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                        </svg></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>







@endsection


