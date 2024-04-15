@extends('layouts.page')
@include($navbar)

@section('body')
    <div class="container">
        <div class="col-md-12">
            <h3>API keys</h3>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>API ID</th>
                    <th>klant naam</th>
                    <th>API key</th>
                    <th>Actief</th>
                    <th>Start datum</th>
                    <th><a href="{{ route('addAPI') }}" class="btn btn-success">Add Employee</a></th>
                </tr>
                </thead>

                <tbody>
                @foreach($keys as $key)
                    <tr>
                        <td>{{ $key->id }}</td>
                        <td>{{ $key->klantenID }}</td>
                        <td>{{ $key->APIkey }}</td>
                        <td>{{ $key->actief }}</td>
                        <td>{{ $key->startdatum }}</td>
                        <td>
                            <!--TODO: make styling not use -15 px, i know this is bad but i hate front end-->
                            <div
                                style="display: flex; align-items: center; margin-bottom: -20px; margin-top: -20px;">
                                <a href="{{ route('editAPI', ['id' => $key->id]) }}"
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
    <div class="container">
        <form method="POST" action="{{ route('APIManagement') }}">
            @csrf
            <div class="row">
                <div class="col-md-2">
                    <input type="text" name="id" class="form-control" placeholder="Filter by ID">
                </div>
                <div class="col-md-2">
                    <input type="text" name="name" class="form-control" placeholder="Filter by Name">
                </div>
                <div class="col-md-2">
                    <input type="text" name="email" class="form-control" placeholder="Filter by Email">
                </div>
                <div class="col-md-2">
                    <select name="worker_type" class="form-control">
                        <option value="">Filter by Role</option>
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


@endsection
