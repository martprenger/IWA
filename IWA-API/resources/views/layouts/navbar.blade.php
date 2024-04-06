<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Left Side Of Navbar -->
    <div class="navbar-brand">
        <img src="{{ asset('images/LogoIWA.jpg') }}" alt="Logo" width="30" height="24"
             class="d-inline-block align-text-top">
    </div>

    <!-- Center Side Of Navbar -->
    <div class="mx-auto order-0">
        <a class="navbar-brand mr-auto" href="{{route('dashboard')}}">Home</a>
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
