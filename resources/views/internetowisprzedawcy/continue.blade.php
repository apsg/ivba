@extends('layouts.logged')

@section('title', 'Dziękujemy')

@section('content')
    <section class="page content">
        <div class="container">
            <h1 class="text-center mt-5">Dziękuję za zaufanie!</h1>
            <p>Czekamy na zaksięgowanie Twojej płatności. W ciagu kilku minut zakupione dostępy powinny być aktywne</p>
            <p>Listę swoich aktywnych dostępów możesz sprawdzić tutaj:</p> <a href="{{ url('/account') }}" class="btn btn-primary">Mój profil</a>
        </div>
    </section>
@endsection

@section('scripts')

    <script type="text/javascript">
        ga('require', 'ecommerce');
        @if($order)
        ga('ecommerce:addTransaction', {
            'id': '{{ $order->payu_order_id ?? "" }}',                     // Transaction ID. Required.
            'affiliation': 'iExcel',   // Affiliation or store name.
            'revenue': '{{ $order->final_total }}',               // Grand Total.
            'currency': 'PLN'
        });

        @if($order->is_full_access)
        ga('ecommerce:addItem', {
            'id': '{{ $order->payu_order_id ?? "" }}',
            'name': 'Pełny dostęp do platformy',
            'sku': 'FULL',
            'category': 'Pełny dostęp',
            'price': '{{ $order->final_total }}',
            'quantity': '1',
            'currency': 'PLN'
        });
        @else
        ga('ecommerce:addItem', {
            'id': '{{ $order->payu_order_id ?? "" }}',
            'name': 'Abonament',
            'sku': 'Abonament',
            'category': 'Abonament',
            'price': '{{ $order->final_total }}',
            'quantity': '1',
            'currency': 'PLN'
        });

        @endif

        ga('ecommerce:send');
        @endif

    </script>

@endsection
