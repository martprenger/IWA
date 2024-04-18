@extends('layouts.page')
@include($navbar)

@section('body')

    <div class="container">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Klantnaam</th>
                    <th>API Key</th>
                    <th></th>
                    <th>Status</th>
                    <th>Startdatum</th>
                    <th><a href="{{ route('addAPI') }}" class="btn btn-success">Add API key</a></th>
                </tr>
                </thead>

                <tbody>
                @foreach($keys as $key)
                    <tr>
                        <td>{{ $key->id }}</td>
                        <td>{{ $key->klant->klantnaam }}</td>
                        <td id="api-key-{{ $key->id }}">{{ $key->APIkey }}</td>
                        <td>
                            <svg id="copyIcon" onclick="copyApiKey('{{ $key->id }}')" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16">
                                <style>
                                    .bi-copy:hover {
                                        transform: scale(1.12); /* 5% bigger */
                                            cursor: pointer;
                                    }
                                </style>
                                <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
                            </svg>

                        </td>
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

    <script>
        function copyApiKey(id) {
            var apiKeyField = document.getElementById('api-key-' + id);
            var apiKeyValue = apiKeyField.innerText.trim();

            // Create a temporary textarea element to copy the text
            var tempTextarea = document.createElement('textarea');
            tempTextarea.value = apiKeyValue;
            document.body.appendChild(tempTextarea);

            // Select the text and copy it to the clipboard
            tempTextarea.select();
            document.execCommand('copy');

            // Remove the temporary textarea
            document.body.removeChild(tempTextarea);
        }
    </script>

@endsection
