@extends('layouts.page')
@include($navbar)

@section('body')

    <div class="container">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th></th>

                </tr>
                </thead>

                <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->klantnaam }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <!--TODO: make styling not use -15 px, i know this is bad but i hate front end-->
                            <div style="display: flex; align-items: center; margin-bottom: -20px; margin-top: -20px; margin-right: -60px;">
                                <a href="{{ route('editcustomer', ['id' => $customer->id]) }}"
                                   class="btn btn-primary" style="margin-right: -20px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                    </svg></a><!-- Edit -->
                                <form method="POST" action="{{ route('deletecustomer') }}"
                                      style="margin-top: 4px; margin-left: 15px">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $customer->id }}">
                                    <button type="submit" class="btn btn-danger"  style="margin-right: -10px"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
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

    <div class="bottom-navbar" style="position: fixed; bottom: 0; width: 100%;">
        <nav class="navbar navbar-expand-lg navbar-light bg-rgba" style="background-color: rgba(77, 153, 231, 1);">
            <!-- Left Side Of Navbar -->
            <div class="navbar-brand" style="margin-left: 35px;">
                <a href="{{ route('addcustomer') }}"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="rgba(173, 255, 47, 1)" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
                    </svg></a>

            </div>
                        <!-- Center Side Of Navbar -->
            <div class="mx-auto order-0">
                <!-- Hier kan nog iets komen -->
            </div>

            <!-- Right Side Of Navbar -->
            <div class="navbar-search" style="margin-right: -60px; margin-top:15px;">
                <form method="POST" action="{{ route('customerlist') }}">
                    @csrf
                    <div class="row justify-content-end">
                        <div class="col-md-3">
                            <input type="text" name="id" class="form-control" placeholder="ID">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="name" class="form-control" placeholder="Naam">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn" style="background-color:rgba(173, 255, 47, 1)"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="22" fill="black)" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                </svg></button>
                        </div>
                    </div>
                </form>
            </div>
        </nav>
    </div>

@endsection
