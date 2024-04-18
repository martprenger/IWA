@extends('layouts.page')
@include($navbar)

@section('body')

    <div class="bottom-navbar" style="position: fixed; bottom: 0; width: 100%;">
        <nav class="navbar navbar-expand-lg navbar-light bg-rgba" style="background-color: rgba(77, 153, 231, 1);">
            <!-- Left Side Of Navbar -->
            <div class="navbar-brand" style="margin-left: 35px;">
                <a href="{{ route('addAPI') }}"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="rgba(173, 255, 47, 1)" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                    </svg></a>

            </div>
            <!-- Center Side Of Navbar -->
            <div class="mx-auto order-0">
                <div class="pagination-links d-flex justify-content-center mt-5" style="margin-bottom: 30px; margin-left: 15px">
                    <ul class="pagination">
                        {{-- Previous Page Link --}}
                        @if ($APIkeys->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">&laquo;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $APIkeys->previousPageUrl() }}" rel="prev">&laquo;</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @if ($APIkeys->lastPage() > 0)
                            @php
                                $startPage = max($APIkeys->currentPage() - 2, 1);
                                $endPage = min($startPage + 4, $APIkeys->lastPage());
                            @endphp
                            @for ($page = $startPage; $page <= $endPage; $page++)
                                @if ($page == $APIkeys->currentPage())
                                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $APIkeys->url($page) }}">{{ $page }}</a></li>
                                @endif
                            @endfor
                        @endif

                        {{-- Next Page Link --}}
                        @if ($APIkeys->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $APIkeys->nextPageUrl() }}" rel="next">&raquo;</a>
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
                <div class="ml-auto " style="margin-top:15px; margin-right: -85px; margin-left: 20px;">
                    <form method="POST" action="{{ route('APIManagements') }}">
                        @csrf
                        <div class="row justify-content-end">
                            <div class="col">
                                <input type="text" name="id" class="form-control" placeholder="ID">
                            </div>
                            <div class="col">
                                <input type="text" name="klantenNaam" class="form-control" placeholder="Klant naam">
                            </div>
                            <div class="col">
                                <input type="text" name="APIkey" class="form-control" placeholder="APIkey">
                            </div>
                            <div class="col">
                                <select name="status" class="form-control">
                                    <option value="">status</option>
                                    <option value="1">active</option>
                                    <option value="0">inactive</option>
                                </select>
                            </div>
                            <div class="col">
                                <input type="date" name="start_date" class="form-control" placeholder="Start Date">
                            </div>
                            <div class="col">
                                <input type="date" name="end_date" class="form-control" placeholder="End Date">
                            </div>

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

    <div class="container">
        <div class="col-md-12">
            <h3>API keys</h3>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>klant naam</th>
                    <th>API key</th>
                    <th>Status</th>
                    <th>Start datum</th>
                </tr>
                </thead>

                <tbody>
                @foreach($APIkeys as $key)
                    <tr>
                        <td>{{ $key->id }}</td>
                        <td>{{ $key->klant->klantnaam }}</td>
                        <td>{{ $key->APIkey }}</td>
                        <td>{{ $key->actief == 0 ? 'Inactive' : 'Active' }}</td>
                        <td>{{ $key->created_at}}</td>
                        <td>
                            <!--TODO: make styling not use -15 px, i know this is bad but i hate front end-->
                            <div
                                style="display: flex; align-items: center; margin-bottom: -20px; margin-top: -20px;">
                                <a href="{{ route('editAPIs', ['id' => $key->id]) }}"
                                   class="btn btn-primary" style="margin-right: 5px;">Edit</a>
                                <form method="POST" action="{{ route('deleteAPI') }}"
                                      style="margin-top: 4px; margin-left: -15px">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $key->id }}">
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



@endsection
