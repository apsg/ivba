@if( Auth::user()->full_access_expires && Auth::user()->full_access_expires->isFuture() )

    @if( !Auth::user()->canAddFullAccess() )
        Ważność Twojego konta jest dłuższa niż rok (ważne do {{ Auth::user()->full_access_expires }}
        ).        Nie        można teraz przedłużyć bardziej.
    @else
        <h1>Przedłuż pełen dostęp do strony</h1>
        <p>Masz już wykupiony pełen dostęp ważny do dnia {{ Auth::user()->full_access_expires }},
            ale możesz go już teraz przedłużyć, jeśli chcesz</p>
        <a href="{{ url('/cart/add_full_access') }}" class="btn btn-primary">Przedłuż dostęp</a>
    @endif
@else
    <h1>Kup pełen dostęp do strony</h1>
    <p>W tym miejscu możesz kupić roczny dostęp do WSZYSTKICH zasobów na inauka.pl na okres 1
        roku.</p>
    <ul style="list-style: circle;">
        <li>Podana cena jest ceną brutto i zawiera 23% VAT - brak innych opłat</li>
        <li>Dostęp jest aktywowany na rok czasu - 365 dni</li>
        <li>Masz prawo w ciągu 30 dni zrezygnować</li>
    </ul>
    <br/>
    <a href="{{ url('/cart/add_full_access') }}" class="btn btn-primary">Dodaj pełen dostęp
        za {{ config('ivba.full_access_price') }} zł brutto do koszyka</a>
    <hr/>
@endif