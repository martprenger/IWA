@extends('layouts.page')
@include($navbar)

@section('body')


    <div>
        <h1>Customer List</h1>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->klantnaam }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>






@endsection
