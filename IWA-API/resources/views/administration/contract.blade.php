@extends('layouts.page')
@include($navbar)

@section('body')
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
                    <th><a href="{{ route('addAPI') }}" class="btn btn-success">Add API key</a></th>
                </tr>
                </thead>

                <tbody>
                @foreach($keys as $key)
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
    <div class="container">
        <form method="POST" action="{{ route('APIManagements') }}">
            @csrf
            <div class="row">
                <div class="col-md-2">
                    <input type="text" name="id" class="form-control" placeholder="ID">
                </div>
                <div class="col-md-2">
                    <input type="text" name="klantenNaam" class="form-control" placeholder="Klant naam">
                </div>
                <div class="col-md-2">
                    <input type="text" name="APIkey" class="form-control" placeholder="APIkey">
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-control">
                        <option value="">status</option>
                        <option value="1">active</option>
                        <option value="0">inactive</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="date" name="start_date" class="form-control" placeholder="Start Date">
                </div>
                <div class="col-md-2">
                    <input type="date" name="end_date" class="form-control" placeholder="End Date">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
    </div>





@endsection

