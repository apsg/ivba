<h3>Użyj kuponu</h3>

<p>Posiadasz kupon przyznający dostęp do treści na stronie? Użyj go poniżej:</p>

@auth()

    <form action="{{ url('/coupon/redeem') }}" method="post">
        @csrf
        <input type="text" name="code" placeholder="wpisz kupon tutaj" class="form-control">

        <button class="btn btn-ivba">Użyj kuponu</button>
    </form>
@else
    <div class="alert alert-error">
        Musisz się zalogować by móc użyć kuponu.
        <a href="{{ route('login') }}">Zaloguj się</a> lub
        <a href="{{ route('register') }}">utwórz konto</a>.
    </div>
@endauth