<header class="header">
    <nav class="navbar">
        <a href="/"><img alt="MKFIT_logo" id="nav-logo" src="{{asset('resources/img/logo/logo_white.png')}}"></a>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="/" class="{{ request()->routeIs('web.homepage') ? 'nav-link-active' : 'nav-link' }}">Domov</a>
            </li>
            <li class="nav-item">
                <a href="/sluzby" class="{{ request()->routeIs('web.servicespage') ? 'nav-link-active' : 'nav-link' }}">Služby</a>
            </li>
            <li class="nav-item">
                <a href="/galeria" class="{{ request()->routeIs('web.gallerypage') ? 'nav-link-active' : 'nav-link' }}">Galéria</a>
            </li>
            <li class="nav-item">
                <a href="/kontakt" class="{{ request()->routeIs('web.contactpage') ? 'nav-link-active' : 'nav-link' }}">Kontakt</a>
            </li>

            @if (Route::has('login'))
                @auth
                    <li class="nav-item">
                        <a href="@if(auth()->check() && auth()->user()->isAdmin()) {{ route('admin.adminhome') }} @else {{ route('dashboard') }} @endif" class="nav-link" style="color: #8add8a">{{ Auth::user()->name }}</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{route('login')}}" class="nav-link" style="color: #C32A2A">Prihlásiť sa</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('register')}}" class="nav-link" style="color: #C32A2A">Zaregistrovať sa</a>
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
