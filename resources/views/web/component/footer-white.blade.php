<footer class="footer-white">
    <div class="container">
        <div class="footer_content">
            <div class="first_section">
                <h3 class="footer_heading">O nás</h3>
                <img src="{{asset('resources/img/logo/logo.png')}}" alt="MKFIT_logo">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, assumenda autem cupiditate delectus deleniti eaque earum et explicabo fugiat itaque omnis placeat praesentium quas reiciendis saepe, tempore voluptate. Modi, obcaecati.
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
                <iframe class="mapa" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d922.922864502847!2d20.42909019728947!3d49.13564837736797!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x473e3c324e653e31%3A0x9462be7cc1641ebd!2zSGxhdm7DqSBuw6FtZXN0aWUgMTg0LzE4LCAwNjAgMDEgS2XFvm1hcm9rLCDQodC70L7QstCw0LrQuNGP!5e0!3m2!1sru!2sus!4v1708272896881!5m2!1sru!2sus" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="fourth_section">
                <h3 class="footer_heading">Kontaktný formulár</h3>
                <form action="">
                    <div class="form_control">
                        <input type="text" placeholder="Meno a priezvisko*">
                        <input type="text" placeholder="Email*">
                    </div>
                    <div class="form_control">
                        <textarea name="" id="" cols="10" rows="5" placeholder="Správa*"></textarea>
                    </div>
                    <button type="button">Odoslať</button>
                </form>
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
