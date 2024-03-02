<section class="price-list_section">
    <h2 class="price-list_heading">Cenník permanentiek</h2>
    <div class="bar"></div>
    <p>Platný od 25.01.2024</p>

    <div class="price-list_container">
        <table class="price-table">
            <tbody>
            <tr>
                <td>Cena za jednorazovú(vstupovú):</td>
                <td>8€</td>
            </tr>
            <tr>
                <td>Cena za mesačnú:</td>
                <td>40€</td>
            </tr>
            </tbody>
        </table>
        @if (Route::has('login'))
            @auth
                <a href="@if(auth()->check() && auth()->user()->isAdmin()) {{ route('admin.adminhome') }} @else {{ route('dashboard') }} @endif" class="interest-button">Mám záujem o permanentku</a>
            @else
                <a href="{{route('register')}}" class="interest-button">Mám záujem o permanentku</a>
            @endauth
        @endif
    </div>
</section>
