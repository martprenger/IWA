<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Left Side Of Navbar -->
    <div class="navbar-brand">
        <img src="{{ asset('images/LogoIWA.jpg') }}" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
    </div>

    <!-- Center Side Of Navbar -->
    <div class="mx-auto order-0">
        <a class="navbar-brand mr-auto" href="{{route('dashboard')}}">Home</a>
        <a class="navbar-brand mr-auto" href={{route ('machinepage')}}>Machines</a>
        <a class="navbar-brand mr-auto" href="#">Settings</a>
        <a class="navbar-brand mr-auto" href="#">Alarm</a>
        <a class="navbar-brand mr-auto" href="{{route ('medewerkers')}}">werknemers</a>
        <a class="navbar-brand mr-auto" href="{{route('logsmedewerkers')}}">logs</a>
    </div>

    <!-- Right Side Of Navbar -->
    <div class="navbar-brand">
        <a class="nav-link disabled" aria-disabled="true">Account</a>
    </div>
</nav>
