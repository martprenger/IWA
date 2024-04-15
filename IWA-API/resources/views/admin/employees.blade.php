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
                    <th><a href="{{ route('addemployees') }}" class="btn btn-success">Add Employee</a></th>
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
    <div class="container">
        <form method="POST" action="{{ route('medewerkers') }}">
            @csrf
            <div class="row">
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
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
    </div>


