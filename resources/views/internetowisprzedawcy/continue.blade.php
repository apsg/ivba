@extends('layouts.logged')

@section('title', 'Dziękujemy')

@section('content')
    <section class="page content">
        <div class="container">
            <h1 class="text-center my-5">Dziękuję za zaufanie!</h1>

            <div class="d-flex rounded-50 bg-white">
                <div class="w-50 p-5">
                    <h3 class="mt-5">Kilka słów na wstęp</h3>

                    <p class="text-black font-primary">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                    <div class="d-flex mt-5">
                        <div class="w-50">
                            <a href="{{ url('/account') }}" class="btn btn-ivba font-size-20">Rozpocznij</a>
                        </div>
                        <img src="{{ asset('/images/internetowisprzedawcy/podpis.png') }}"/>
                    </div>
                </div>
                <div class="w-50 h-100">
                    <img style="margin-top: -80px" src="{{ asset('/images/internetowisprzedawcy/mati_shadow.png') }}" />
                </div>
            </div>
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
