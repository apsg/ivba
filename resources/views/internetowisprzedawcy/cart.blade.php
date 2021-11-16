@extends('layouts.buyaccess')

@section('title', 'Koszyk')

@section('content')
    <section class="page content">
        <div class="container">
            <h1>Twój koszyk</h1>
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nazwa elementu</th>
                    <th>Okres dostępu</th>
                    <th>Cena zł</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if($order->is_full_access)
                    <tr>
                        <th>1</th>
                        <td>Pełen dostęp do wszystkich materiałów</td>
                        <td>{{ $order->duration }} miesięcy</td>
                        <td>{{ $order->sum() }}</td>
                        <td>
                            <a href="{{ url('/cart/remove_full_access') }}" alt="usuń element z koszyka"><i
                                        class="fa fa-remove"></i></a>
                        </td>
                    </tr>
                @elseif($order->is_easy_access)
                    <tr>
                        <th>1</th>
                        <td>{{ $order->description }}</td>
                        <td>Miesięcy: {{ $order->duration }}</td>
                        <td>{{ $order->sum() }}</td>
                        <td>
                            <a href="{{ url('/order/'.$order->id.'/remove_easy_access') }}"
                               alt="usuń element z koszyka"><i
                                        class="fa fa-remove"></i></a>
                        </td>
                    </tr>
                @else
                    {{-- do nothing for now --}}
                @endif
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3" class="align-right">
                        <strong>Suma:</strong>
                    </td>
                    <td>{{ $order->sum() }}</td>
                    <td></td>
                </tr>
                </tfoot>
            </table>

            @if($order->coupons()->count() > 0)
                <h3>Twoje kody rabatowe</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Kod</th>
                        <th>Wartość</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->coupons as $coupon)
                        <tr>
                            <td>{{ $coupon->code }}</td>
                            <td>{{ $coupon->amount }} {{ $coupon->type == 1 ? "zł" : "%" }}</td>
                            <td>
                                <a href="{{ $coupon->removeLink($order) }}" alt="usuń kod z koszyka"><i
                                            class="fa fa-remove"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <hr/>

            @endif

            <label>Suma zamówienia po uwzględnieniu rabatów: </label>
            <table class="table">
                <thead>
                <tr>
                    <th>Kwota netto zamówienia</th>
                    <th>Podatek 23%</th>
                    <th>Kwota brutto do zapłaty</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $order->netto() }}</td>
                    <td>{{ $order->tax() }}</td>
                    <td><strong>{{ $order->total() }} zł</strong></td>
                </tr>
                </tbody>
            </table>

            <div class="form-group">
                <form action="{{ url('/order/'.$order->id.'/add_coupon') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="col-md-3">
                        <h5>Dodaj kod rabatowy: </h5>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="code" class="form-control">
                        <p>Wielkość liter ma znaczenie!</p>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-ivba">Dodaj kupon</button>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <hr/>
                    <div class="alert alert-info">
                        Po zaakceptowaniu regulaminu strony zobaczysz dostępne metody płatności.
                    </div>
                    <div class="form-group">
                        <input id="regulamin" type="checkbox" name="rules" class="">
                        <label for="regulamin" class="form-check-label">
                            Akceptuję <a href="{{ url('/regulamin') }}" target="_blank">Regulamin
                                strony {{ config('app.name') }}</a>
                            (wymagane)
                        </label>
                    </div>
                    <hr/>

                    <div id="selector" style="display: none;">
                        {!! $form !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#regulamin").change(function () {
                if ($(this).is(":checked")) {
                    $('#selector').show();
                    $("#pay").css({'pointer-events': 'auto'});
                } else {
                    $('#selector').hide();
                    $("#pay").css({'pointer-events': 'none'});
                }
            });

            $('#pay').click(function () {
                if (!$("#regulamin").is(':checked')) {
                    alert('Prosimy wpierw przeczytać i zaakceptować regulamin');
                }
            });
        });
    </script>
@endpush
