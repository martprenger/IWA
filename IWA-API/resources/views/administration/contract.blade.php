@extends('layouts.page')
@include($navbar)

@section('body')

    <div class="bottom-navbar" style="position: fixed; bottom: 0; width: 100%;">
        <nav class="navbar navbar-expand-lg navbar-light bg-rgba" style="background-color: rgba(77, 153, 231, 1);">
            <!-- Left Side Of Navbar -->
            <div class="navbar-brand" style="margin-left: 35px;">
                <a href="{{ route('customer') }}"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="rgba(173, 255, 47, 1)" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                    </svg></a>

            </div>
            <!-- Center Side Of Navbar -->
            <div class="mx-auto order-0">
                <!-- Hier kan nog iets komen -->
            </div>

            <!-- Right Side Of Navbar -->
            <div class="navbar-search" style="margin-right: -60px; margin-top:15px;">
                <form method="POST" action="{{ route('medewerkers') }}">
                    @csrf
                    <div class="row justify-content-end">

                            <div class="col-md-2">
                                <input type="text" name="id" class="form-control" placeholder="ID">
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="klantenNaam" class="form-control" placeholder="Klant naam">
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="aantalstations" class="form-control" placeholder="Aantal stations">
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="aantalpermisions" class="form-control" placeholder="Aantal permisions">
                            </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn" style="background-color:rgba(173, 255, 47, 1)"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="22" fill="black)" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                </svg></button>
                        </div>
                    </div>
                </form>
            </div>
        </nav>
    </div>

    <div class="container">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>klant naam</th>
                    <th>Aantal stations</th>
                    <th>Aantal permisions</th>
                    <th><a href="{{ route('addcontract') }}" class="btn btn-success">make new contract</a></th>
                </tr>
                </thead>

                <tbody>
                @foreach($contracten as $contract)
                    <tr>
                        <td>{{ $contract->id }}</td>
                        <td>{{ $contract->klant->klantnaam }}</td>
                        <td>{{ optional($contract->stations)->count() ?? 0 }}</td>
                        <td>{{ optional($contract->permissions)->count() ?? 0 }}</td>
                        <td>
                            <!--TODO: make styling not use -15 px, i know this is bad but i hate front end-->
                            <div
                                style="display: flex; align-items: center; margin-bottom: -20px; margin-top: -20px;">
                                <a href="{{ route('editcontract', ['id' => $contract->id]) }}"
                                   class="btn btn-primary" style="margin-right: 5px;">Edit</a>
                                <form method="POST" action="{{ route('deletecontract') }}"
                                      style="margin-top: 4px; margin-left: -15px">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $contract->id }}">
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

