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
                    <input type="text" name="aantalstations" class="form-control" placeholder="Aantal stations">
                </div>
                <div class="col-md-2">
                    <input type="text" name="aantalpermisions" class="form-control" placeholder="Aantal permisions">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
    </div>





@endsection

