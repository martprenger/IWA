@extends('layouts.page')
@include($navbar)

@section('body')
    <div class="container-fluid pl-0">
        <div class="col-md-12">
            <h3>Error</h3>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Station Name</th>
                    <th>Error description</th>
                    <th>Error count</th>
                    <th>First error</th>
                    <th>Last error</th>

                </tr>
                </thead>

                <tbody>
                @foreach($errors as $error)
                    <tr>
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

        <div class="pagination-links">
            {{ $errors->links() }}
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
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
    </div>

    <div class="bottom-navbar" style="position: fixed; bottom: 0; width: 100%;">
        <nav class="navbar navbar-expand-lg navbar-light bg-rgba" style="background-color: rgba(77, 153, 231, 1);">
            <!-- Left Side Of Navbar -->
            <div class="navbar-brand" style="margin-left: 35px;">
            </div>
            <!-- Center Side Of Navbar -->
            <div class="mx-auto order-0">
                <!-- Hier kan nog iets komen -->
            </div>

            <!-- Right Side Of Navbar -->

        </nav>
    </div>
@endsection


