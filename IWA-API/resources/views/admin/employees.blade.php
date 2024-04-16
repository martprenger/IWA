@extends('layouts.page')
@include($navbar)
@section('body')

    <div class="container">
        <div class="col-md-12">
            <h3>Employees</h3>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>Employee Email</th>
                    <th>Employee Role</th>

                </tr>
                </thead>

                <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->worker_type }}</td>
                        <td>
                            <!--TODO: make styling not use -15 px, i know this is bad but i hate front end-->
                            <div
                                style="display: flex; align-items: center; margin-bottom: -20px; margin-top: -20px;">
                                <a href="{{ route('editemployees', ['id' => $employee->id]) }}"
                                   class="btn btn-primary" style="margin-right: 5px;">Edit</a>
                                <form method="POST" action="{{ route('deleteemployee') }}"
                                      style="margin-top: 4px; margin-left: -15px">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $employee->id }}">
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


    <div class="bottom-navbar" style="position: fixed; bottom: 0; width: 100%;">
        <nav class="navbar navbar-expand-lg navbar-light bg-rgba" style="background-color: rgba(77, 153, 231, 1);">
            <!-- Left Side Of Navbar -->
            <div class="navbar-brand" style="margin-left: 35px;">
                <a href="{{ route('addemployees') }}"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="rgba(173, 255, 47, 1)" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
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
                <form method="POST" action="{{ route('medewerkers') }}">
                    @csrf
                    <div class="row justify-content-end">
                        <div class="col-md-2">
                            <input type="text" name="id" class="form-control" placeholder="ID">
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="name" class="form-control" placeholder="Naam">
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="col-md-2">
                            <select name="worker_type" class="form-control">
                                <option value="">Role</option>
                                <option value="admin">Admin</option>
                                <option value="wetenschappelijk">Wetenschappelijk</option>
                                <option value="administratief">Administratief</option>
                            </select>
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

@endsection


