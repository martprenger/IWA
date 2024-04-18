@extends('layouts.page')
@include($navbar)

@section('body')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet-draw/dist/leaflet.draw.css" />

    <!-- Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- Leaflet.draw JavaScript -->
    <script src="https://unpkg.com/leaflet-draw/dist/leaflet.draw.js"></script>

    <style>
        body {
            background-image: url('{{ asset('images/loginwallpaper.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>

    <div>
        <div class="container-md" style="position: absolute; top: 55%; left: 50%; transform: translate(-50%, -50%);">
            <form method="POST" action="{{ route('addcontract') }}">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Klantnummer</label>
                    <input type="text" placeholder="Klantnummer" id="customer_id" class="form-control"
                           aria-describedby="emailHelp" name="customer_id" required autofocus>
                    @if ($errors->has('customer_id'))
                        <span class="text-danger">{{ $errors->first('customer_id') }}</span>
                    @endif
                </div>

                <div class="navbar-brand">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="navbarDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Kies weerstationoptie
                    </button>

                    <div id="inputs">
                        <div id="mapContainer"></div>

                    </div>

                    <div class="dropdown-menu dropdown" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" onclick="addGeolocation()">Geolocation</a>
                        <a class="dropdown-item" onclick="addInputField('countryName.country')">Country</a>
                        <a class="dropdown-item" onclick="addInputField('county')">County</a>
                        <a class="dropdown-item" onclick="addInputField('state')">State</a>
                        <a class="dropdown-item" onclick="addInputField('municipality')">Municipality</a>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Einddatum</label>
                    <div class="col-md-3">
                        <input type="date" name="expiration_date" class="form-control" placeholder="End Date">
                    </div>
                    @if ($errors->has('expiration_date'))
                        <span class="text-danger">{{ $errors->first('expiration_date') }}</span>
                    @endif
                </div>

                <div class="btn-group-toggle" data-toggle="buttons">
                    <label for="exampleInputEmail1" class="form-label">Permissions</label>
                    <div style="text-align: center">
                    <label class="btn btn-secondary m-1">
                        <input type="checkbox" autocomplete="off" id="TEMP" name="permissionsA[]" value="TEMP"> TEMP
                    </label>
                    <label class="btn btn-secondary m-1">
                        <input type="checkbox" autocomplete="off" id="DEWP" name="permissionsA[]" value="DEWP"> DEWP
                    </label>
                    <label class="btn btn-secondary m-1">
                        <input type="checkbox" autocomplete="off" id="STP" name="permissionsA[]" value="STP"> STP
                    </label>
                    <label class="btn btn-secondary m-1">
                        <input type="checkbox" autocomplete="off" id="SLP" name="permissionsA[]" value="SLP"> SLP
                    </label>
                    <label class="btn btn-secondary m-1">
                        <input type="checkbox" autocomplete="off" id="VISIB" name="permissionsA[]" value="VISIB"> VISIB
                    </label>
                    <label class="btn btn-secondary m-1">
                        <input type="checkbox" autocomplete="off" id="WDSP" name="permissionsA[]" value="WDSP"> WDSP
                    </label>
                    <label class="btn btn-secondary m-1">
                        <input type="checkbox" autocomplete="off" id="PRCP" name="permissionsA[]" value="PRCP"> PRCP
                    </label>
                    <label class="btn btn-secondary m-1">
                        <input type="checkbox" autocomplete="off" id="SNDP" name="permissionsA[]" value="SNDP"> SNDP
                    </label>
                    <label class="btn btn-secondary m-1">
                        <input type="checkbox" autocomplete="off" id="FRSHTT" name="permissionsA[]" value="FRSHTT">
                        FRSHTT
                    </label>
                    <label class="btn btn-secondary m-1">
                        <input type="checkbox" autocomplete="off" id="CLDC" name="permissionsA[]" value="CLDC"> CLDC
                    </label>
                    <label class="btn btn-secondary m-1">
                        <input type="checkbox" autocomplete="off" id="WNDDIR" name="permissionsA[]" value="WNDDIR">
                        WNDDIR
                    </label>
                    @if ($errors->has('permissionsA'))
                        <span class="text-danger">{{ $errors->first('permissionsA') }}</span>
                    @endif
                </div>
                    <div style="text-align: center">
                <button type="submit" class="btn btn-primary m-1">Maak contract</button>
                    </div></div>
            </form>
        </div>

        <script>
            function addGeolocation() {
                var mapContainer = document.getElementById('mapContainer');
                var map = document.getElementById('map');

                if (!map) {
                    // Create map container and add it above the inputs div
                    mapContainer.innerHTML = '<div id="map"></div><input type="hidden" id="polygonCoords" name="polygonCoords">';
                    initMap();
                } else {
                    // Remove map container
                    mapContainer.innerHTML = '';
                }
                // Handle other options or actions here
            }
            function addInputField(option) {
                var div = document.getElementById('inputs');
                var input = document.createElement('input');
                input.type = 'text';
                input.name = 'stations[' + option + '][]';
                input.className = 'form-control';
                input.placeholder = 'Enter station for ' + option;

                // Add a button to remove the input field
                var removeButton = document.createElement('button');
                removeButton.type = 'button';
                removeButton.textContent = 'Remove';
                removeButton.className = 'btn btn-danger';
                removeButton.onclick = function() {
                    div.removeChild(input);
                    div.removeChild(removeButton);
                };

                div.appendChild(input);
                div.appendChild(removeButton);
            }
            function initMap() {
                var map = L.map('map').setView([51.505, -0.09], 13);

                // Add OpenStreetMap tiles
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);

                // Initialize the Leaflet.draw control
                var drawnItems = new L.FeatureGroup();
                map.addLayer(drawnItems);
                var drawControl = new L.Control.Draw({
                    draw: {
                        polygon: true,
                        polyline: false,
                        rectangle: false,
                        circle: false,
                        marker: false
                    },
                    edit: {
                        featureGroup: drawnItems,
                        remove: true
                    }
                });
                map.addControl(drawControl);

                // Array to store polygon coordinates
                var polygons = [];

                // Add event listeners for draw events
                map.on('draw:created', function (e) {
                    var layer = e.layer;
                    drawnItems.addLayer(layer);

                    // Extract coordinates of the drawn polygon
                    var coordinates = layer.getLatLngs()[0].map(function (latlng) {
                        return [latlng.lat, latlng.lng];
                    });

                    // Add coordinates to the array
                    polygons.push(coordinates);

                    // Populate hidden input field with polygon coordinates
                    document.getElementById('polygonCoords').value = JSON.stringify(polygons);
                });
            }
        </script>

        <style>
            #map { height: 500px;
                width: 500px;
            }
        </style>


@endsection
