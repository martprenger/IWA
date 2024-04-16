@extends('layouts.page')
@include($navbar)

@section('body')

    <div>
        <div class="container-image">
            <img src="{{ asset('images/LogoIWA.jpg') }}" alt="">
        </div>
        <div class="container-md">
            <form method="POST" action="{{ route('addcontract') }}">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">klant nummer</label>
                    <input type="text" placeholder="klant nummer" id="customer_id" class="form-control"
                           aria-describedby="emailHelp" name="customer_id" required autofocus>
                    @if ($errors->has('customer_id'))
                        <span class="text-danger">{{ $errors->first('customer_id') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">expiration date</label>
                    <div class="col-md-2">
                        <input type="date" name="expiration_date" class="form-control" placeholder="End Date">
                    </div>
                    @if ($errors->has('expiration_date'))
                        <span class="text-danger">{{ $errors->first('expiration_date') }}</span>
                    @endif
                </div>

                <div class="btn-group-toggle" data-toggle="buttons">
                    <label for="exampleInputEmail1" class="form-label">Permissions</label>
                    <label class="btn btn-secondary">
                        <input type="checkbox" autocomplete="off" id="TEMP" name="permissionsA[]" value="TEMP"> TEMP
                    </label>
                    <label class="btn btn-secondary">
                        <input type="checkbox" autocomplete="off" id="DEWP" name="permissionsA[]" value="DEWP"> DEWP
                    </label>
                    <label class="btn btn-secondary">
                        <input type="checkbox" autocomplete="off" id="STP" name="permissionsA[]" value="STP"> STP
                    </label>
                    <label class="btn btn-secondary">
                        <input type="checkbox" autocomplete="off" id="SLP" name="permissionsA[]" value="SLP"> SLP
                    </label>
                    <label class="btn btn-secondary">
                        <input type="checkbox" autocomplete="off" id="VISIB" name="permissionsA[]" value="VISIB"> VISIB
                    </label>
                    <label class="btn btn-secondary">
                        <input type="checkbox" autocomplete="off" id="WDSP" name="permissionsA[]" value="WDSP"> WDSP
                    </label>
                    <label class="btn btn-secondary">
                        <input type="checkbox" autocomplete="off" id="PRCP" name="permissionsA[]" value="PRCP"> PRCP
                    </label>
                    <label class="btn btn-secondary">
                        <input type="checkbox" autocomplete="off" id="SNDP" name="permissionsA[]" value="SNDP"> SNDP
                    </label>
                    <label class="btn btn-secondary">
                        <input type="checkbox" autocomplete="off" id="FRSHTT" name="permissionsA[]" value="FRSHTT">
                        FRSHTT
                    </label>
                    <label class="btn btn-secondary">
                        <input type="checkbox" autocomplete="off" id="CLDC" name="permissionsA[]" value="CLDC"> CLDC
                    </label>
                    <label class="btn btn-secondary">
                        <input type="checkbox" autocomplete="off" id="WNDDIR" name="permissionsA[]" value="WNDDIR">
                        WNDDIR
                    </label>
                    @if ($errors->has('permissionsA'))
                        <span class="text-danger">{{ $errors->first('permissionsA') }}</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">make contract</button>
            </form>
        </div>

@endsection
