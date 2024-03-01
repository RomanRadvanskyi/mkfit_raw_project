<header class="header">
    <nav class="navbar">
        <a href="#"><img alt="MKFIT_logo" id="nav-logo" src="{{asset('resources/img/logo/logo_white.png')}}"></a>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="#" class="nav-link">Domov</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Služby</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Galéria</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Kontakt</a>
            </li>

            @if (Route::has('login'))
                @auth

                    <div class="dropdown">

                        <button class="dropbtn">
                            <x-nav-link :href="auth()->check() && auth()->user()->isAdmin() ? route('admin.adminhome') : route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ Auth::user()->name }}
                            </x-nav-link>
                        </button>
                        <div class="dropdown-content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </div>

                @else
                    <li class="nav-item">
                        <a href="{{route('login')}}" class="nav-link">Login</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('register')}}" class="nav-link">Register</a>
                    </li>
                @endauth

            @endif
        </ul>
        <div class="hamburger">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
    </nav>
</header>
