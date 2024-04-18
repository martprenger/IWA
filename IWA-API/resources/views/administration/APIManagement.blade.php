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
                <div class="pagination-links d-flex justify-content-center mt-5" style="margin-bottom: 30px; margin-left: -540px">
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
                <div class="ml-auto " style="margin-top:15px; margin-right: -60px; ">
                    <form method="POST" action="{{ route('APIManagements') }}">
                        @csrf
                        <div class="row justify-content-end">
                            <div class="col">
                                <input type="text" name="id" class="form-control" placeholder="ID">
                            </div>
                            <div class="col">
                                <input type="text" name="klantenNaam" class="form-control" placeholder="Klantnaam">
                            </div>
                            <div class="col">
                                <input type="text" name="APIkey" class="form-control" placeholder="API key">
                            </div>
                            <div class="col">
                                <select name="status" class="form-control">
                                    <option value="">Status</option>
                                    <option value="1">Actief</option>
                                    <option value="0">Inactief</option>
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
                <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Klantnaam</th>
                    <th>API key</th>
                    <th></th>
                    <th>Status</th>
                    <th>Startdatum</th>
                </tr>
                </thead>

                <tbody>
                @foreach($APIkeys as $key)
                    <tr>
                        <td>{{ $key->id }}</td>
                        <td>{{ $key->klant->klantnaam }}</td>
                        <td>{{ $key->APIkey }}</td>
                        <td><svg onclick="copyApiKey('{{ $key->APIkey }}')" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16" style="margin-left:15px">
                                <style>
                                    .bi-copy:hover {
                                        transform: scale(1.10); /* 5% bigger */
                                        cursor: pointer; /* Change cursor to pointer on hover */
                                    }
                                </style>
                                <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
                            </svg></td>
                        <td>{{ $key->actief == 0 ? 'Inactive' : 'Active' }}</td>
                        <td>{{ $key->created_at}}</td>
                        <td>
                            <!--TODO: make styling not use -15 px, i know this is bad but i hate front end-->
                            <div style="display: flex; align-items: center; margin-bottom: -20px; margin-top: -20px; margin-right: -35px;">
                                <a href="{{ route('editAPIs', ['id' => $key->id]) }}"
                                   class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                    </svg></a><!-- Edit -->
                                <form method="POST" action="{{ route('deleteAPI') }}"
                                      style="margin-top: 4px">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $key->id }}">
                                    <button type="submit" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                        </svg></button><!-- Remove -->
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function copyApiKey(apiKey) {
            // Create a temporary textarea element to copy the text
            var tempTextarea = document.createElement('textarea');
            tempTextarea.value = apiKey;
            document.body.appendChild(tempTextarea);

            // Select the text and copy it to the clipboard
            tempTextarea.select();
            document.execCommand('copy');

            // Remove the temporary textarea
            document.body.removeChild(tempTextarea);
        }
    </script>


@endsection
