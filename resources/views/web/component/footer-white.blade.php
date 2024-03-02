<footer class="footer-white">
    <div class="container">
        <div class="footer_content">
            <div class="first_section">
                <h3 class="footer_heading">O nás</h3>
                <img src="{{asset('resources/img/logo/logo.png')}}" alt="MKFIT_logo">
                <p>
                    Víta Vás naše moderné fitness centrum, kde spojujeme starostlivosť o zdravie s radosťou z cvičenia.
                    S našimi certifikovanými trénermi a super kolektívom v MK FIT vás motivujeme dosiahnuť vaše fitness ciele.
                    Sledujte nás na sociálnych sieťach a buďte s nami v kontakte pri zdieľaní tipov, motivácie a najnovších noviniek z nášho fitnes centra.
                </p>
                <div class="social_icons-white">
                    <a href="https://www.instagram.com/mk_fit_marcel/"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://www.facebook.com/profile.php?id=100057226549301"><i class="fa-brands fa-facebook"></i></a>
                </div>
            </div>
            <div class="second_section">
                <h3 class="footer_heading">Čo hľadáte?</h3>
                <ul>
                    <li><a href="#">Domov</a></li>
                    <li><a href="#">Služby</a></li>
                    <li><a href="#">Galéria</a></li>
                    <li><a href="#">Kontakt</a></li>
                    @if (Route::has('login'))
                        @auth
                            <li><a href="@if(auth()->check() && auth()->user()->isAdmin()) {{ route('admin.adminhome') }} @else {{ route('dashboard') }} @endif">Môj účet ({{ Auth::user()->name }})</a></li>
                        @else
                            <li><a href="{{route('login')}}">Prihlásiť sa</a></li>
                            <li><a href="{{route('register')}}">Zagistrovať sa</a></li>
                        @endauth
                    @endif

                </ul>
            </div>
            <div class="third_section">
                <h3 class="footer_heading">Mapa</h3>
                <div class="div_mapa">
                    <iframe class="mapa" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d922.922864502847!2d20.42909019728947!3d49.13564837736797!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x473e3c324e653e31%3A0x9462be7cc1641ebd!2zSGxhdm7DqSBuw6FtZXN0aWUgMTg0LzE4LCAwNjAgMDEgS2XFvm1hcm9rLCDQodC70L7QstCw0LrQuNGP!5e0!3m2!1sru!2sus!4v1708272896881!5m2!1sru!2sus" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_txt">
        <p><?php echo '&copy; '.date('Y').' Radvanskyi Roman';?></p>
    </div>
</footer>
<script src="https://kit.fontawesome.com/9da21f579b.js" crossorigin="anonymous"></script>
<script src="{{ asset('resources/js/hamburger.js') }}"></script>
</body>
</html>
