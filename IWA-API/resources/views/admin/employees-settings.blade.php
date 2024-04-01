@extends('layouts.page')
@include('layouts.admin_navbar')
@section('body')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Employees Settings</h1>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h3>Employees</h3>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>Employee Name</th>
                                    <th>Employee Email</th>
                                    <th>Employee Role</th>
                                    <th>Employee Status</th>
                                    <th><a href="{{ route('addemployees') }}" class="btn btn-success">Add Employee</a></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->id }}</td>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->role }}</td>
                                        <td>{{ $employee->status }}</td>
                                        <td>
                                            <div style="display: flex; align-items: center; margin-bottom: -15px; margin-top: -15px;">
                                                <a href="{{ route('admin', $employee->id) }}" class="btn btn-primary" style="margin-right: 5px;">Edit</a>
                                                <form method="POST" action="{{ route('deleteemployee') }}" style="margin-top: 15px;">
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
            </div>
        </div>
    </div>

