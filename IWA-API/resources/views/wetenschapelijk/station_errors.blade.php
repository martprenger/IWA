@extends('layouts.page')
@include($navbar)

@section('body')

    <div class="bottom-navbar" style="position: fixed; bottom: 0; width: 100%;">
        <nav class="navbar navbar-expand-lg navbar-light bg-rgba" style="background-color: rgba(77, 153, 231, 1);">
            <!-- Left Side Of Navbar -->
            <div class="navbar-brand">
            </div>
            <div class="mx-auto order-0">
                <div class="pagination-links d-flex justify-content-center mt-5" style="margin-bottom: 30px; margin-left: 15px">
                    <ul class="pagination">
                        {{-- Previous Page Link --}}
                        @if ($errors->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">&laquo;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $errors->previousPageUrl() }}" rel="prev">&laquo;</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @if ($errors->lastPage() > 0)
                            @php
                                $startPage = max($errors->currentPage() - 2, 1);
                                $endPage = min($startPage + 4, $errors->lastPage());
                            @endphp
                            @for ($page = $startPage; $page <= $endPage; $page++)
                                @if ($page == $errors->currentPage())
                                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $errors->url($page) }}">{{ $page }}</a></li>
                                @endif
                            @endfor
                        @endif

                        {{-- Next Page Link --}}
                        @if ($errors->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $errors->nextPageUrl() }}" rel="next">&raquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">&raquo;</span>
                            </li>
                        @endif

                    </ul>
                </div>
            </div>
            <!-- Center Side Of Navbar -->
            <div class="mx-auto order-0">
                <!-- Hier kan nog iets komen -->
            </div>

            <!-- Right Side Of Navbar -->
            <div class="ml-auto" style="margin-right:-50px; margin-top: 15px;">
                <form method="POST" action="{{ route('stationerror') }}">
                    @csrf
                    <div class="row">
                        <!-- Modify form fields as per Geolocation model attributes -->
                        <div class="col">
                            <input type="text" name="station_name" class="form-control" placeholder="Station Name">
                        </div>

                        <div class="col">
                            <button type="submit" class="btn" style="background-color:rgba(173, 255, 47, 1)"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="22" fill="black)" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                </svg></button>
                        </div>
                    </div>
                </form>
            </div>


            @endsection
        </nav>
    </div>

    <div class="container">
        <div class="col-md-12" style="margin-bottom: 90px">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Station naam</th>
                    <th>Storingsbeschrijving</th>
                    <th>Aantal storingen</th>
                    <th>Eerste storing</th>
                    <th>Meest recente storing</th>
                    <th></th>

                </tr>
                </thead>

                <tbody>
                @foreach($errors as $error)
                    <tr class="mb-3">
                        <td>{{ $error->station_name }}</td>
                        <td>{{ $error->error }}</td>
                        <td>{{ $error->count }}</td>
                        <td>{{ $error->created_at }}</td>
                        <td>{{ $error->updated_at }}</td>

                        <td>
                            <!--TODO: make styling not use -15 px, i know this is bad but i hate front end-->
                            <div
                                style="display: flex; align-items: center; margin-bottom: -20px; margin-top: -20px;">
                                <form method="POST" action="{{ route('deletestationerror') }}"
                                      style="margin-top: 4px; margin-left: -15px">
                                    @csrf
                                    <input type="hidden" name="name" value="{{ $error->station_name }}">
                                    <input type="hidden" name="error" value="{{ $error->error }}">
                                    <button type="submit" class="btn btn-danger" style="margin-right: -20px"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
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



