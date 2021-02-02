<h5>Twoje dane rozliczeniowe:</h5>
<p>Imię i nazwisko: <strong>{{ \Auth::user()->full_name }}</strong></p>
<p>Adres: <strong>{{ \Auth::user()->address }}</strong></p>
<p>Złe dane? Zmień je w ustawieniach swojego profilu:
    <a href="{{ url('account') }}" class="btn btn-sm btn-info">Przejdź do ustawień profilu</a>
</p>
<hr/>

<p>Opis abonamentu</p>

<form action="{{ url('/subscription/create') }}" method="post">
    @csrf

    <price-and-coupon
            price="{{ setting('ivba.subscription_price') }}"
            first_price="{{ setting('ivba.subscription_price_first') }}"
            first_duration="{{ setting('ivba.subscription_duration_first') }}"
    ></price-and-coupon>

    <label>
        <input type="checkbox" name="rules" required="required" value="1">
        Zapoznałam/zapoznałem się i zgadzam z
        <a style="vertical-align: bottom;" href="{{ url('/regulamin') }}" target="_blank">regulaminem
            strony {{ config('app.name') }}
        </a>

    </label><br/><br/>

    <div class="alert alert-info d-flex">
        <div class="align-self-center pr-3">
            <i class="fa fa-2x fa-info"></i>
        </div>
        <div>
            <strong> W kolejnych miesiącach automatycznie pobierzemy kwotę abonamentu z Twojej karty. W każdej chwili
                możesz zrezygnować z abonamentu </strong>
            (Moje Konto ->Anuluj subskrypcję lub pisząc maila hello@{{ config('app.name') }} ) Pamiętaj w ciągu 30 dni
            możesz zrezygnować z naszej usługi. Transakcje kartą obsługuję Elavon z Tpay.com - nasza firma nie ma
            dostępu do danych z Twojej karty.
        </div>
    </div>
    <button class="btn btn-ivba"><i class="fa fa-money"></i> > Przejdź do operatora płatności
        by wykupić abonament
    </button>
</form>
