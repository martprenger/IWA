@extends('layouts.page')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('body')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-4">
                <div class="card p-3">
                    <form action="">
                        <div class="mb-3">
                            <label class="form-group" for="employee_id">Personeelsnummer:</label>
                            <input type="text" class="form-control form-group" name="employee_id">
                        </div>
                        <div class="mb-3">
                            <label class="form-group" for="employee_id">Personeelsnummer:</label>
                            <input type="text" class="form-control form-group" name="employee_id">
                        </div>
                        <div class="mb-3">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Select Option
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#" data-value="1">Option 1</a>
                                <a class="dropdown-item" href="#" data-value="2">Option 2</a>
                                <a class="dropdown-item" href="#" data-value="3">Option 3</a>
                                <!-- Add more options as needed -->
                                </div>
                            </div>

                            <!-- <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Rol
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" >
                                    @foreach ($roles as $role)
                                        <a class="dropdown-item" href="#">{{ $role->name }}</a>
                                    @endforeach
                                </div>
                            </div> -->
                        </div>
                        <div class="">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<p>{{ $roles }}</p>
