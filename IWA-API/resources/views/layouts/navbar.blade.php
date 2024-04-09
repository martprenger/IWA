<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Left Side Of Navbar -->
    <div class="navbar-brand">
        <img src="{{ asset('images/LogoIWA.jpg') }}" alt="Logo" width="30" height="24"
             class="d-inline-block align-text-top">
    </div>

    <!-- Center Side Of Navbar -->
    <div class="mx-auto order-0">
        <a class="navbar-brand mr-auto" href="{{route('dashboard')}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
            </svg></a>
        <a class="navbar-brand mr-auto" href={{route ('machinepage')}}>Machines</a>
        <a class="navbar-brand mr-auto" href="#">Settings</a>
        <a class="navbar-brand mr-auto" href="#">Alarm</a>
    </div>

    <!-- Right Side Of Navbar -->
    <div class="navbar-brand">
            <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
    </div>
</nav>
