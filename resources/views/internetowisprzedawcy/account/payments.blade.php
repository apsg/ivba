<h5>Twoje Płatności</h5>
<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>Kod płatności</th>
        <th>Opis</th>
        <th>Kwota PLN</th>
        <th>Opłacono</th>
        <th>Faktura</th>
    </tr>
    </thead>
    <tbody>
    @foreach($user->confirmedOrders() as $order)
        <tr>
            <th scope="row">{{ $order->id }}</th>
            <td>{{ $order->payu_order_id ?? $order->id }}</td>
            <td>
                {{ $order->getDescription() }}
                @if($order->isQuickSales() && $order->quick_sales[0]->file_url !== null)
                    <a target="_blank" href="{{ url($order->quick_sales[0]->file_url) }}" class="ml-1">
                        <i class="fa fa-link"></i> Pobierz
                    </a>
                @endif
            </td>
            <td>{{ $order->final_total ?? $order->total() }}</td>
            <td>{{ $order->confirmed_at }}</td>
            <td>
                @if($order->hasInvoice())
                    <a href="{{ $order->invoiceDownloadUrl() }}" class="btn btn-primary" target="_blank">
                        <i class="fa fa-download"></i> Pobierz
                    </a>
                @elseif($order->invoice_request!==null)
                    @if($order->invoice_request->refused_at !== null)
                        Odrzucono dnia {{ $order->invoice_request->refused_at }}
                    @else
                        Weryfikujemy dane. Po potwierdzeniu otrzymasz fakturę mailem lub będzie ona do pobrania w tym
                        miejscu
                    @endif
                @else
                    <a href="{{ url('/order/'.$order->id.'/request-invoice') }}" class="btn btn-ivba">Poproś o
                        fakturę</a>
                @endif
            </td>
        </tr>
    @endforeach
    @foreach($payments as $payment)
        <tr>
            <th scope="row">{{ $payment->id }}</th>
            <td>{{ $payment->id }}</td>
            <td>
                {{ $payment->title }}<br/>
                @if($payment->is_recurrent)
                    <span class="text-info"><i
                                class="fa fa-info"></i> Automatyczna płatność miesięczna</span>
                @else
                    <span class="text-info"><i
                                class="fa fa-info"></i> Pierwsza płatność w abonamencie</span>
                @endif
            </td>
            <td>{{ $payment->amount }}</td>
            <td>
                @if($payment->confirmed_at)
                    <span class="text-success"><i class="fa fa-check"></i> Płatność zrealizowana {{ $payment->confirmed_at }}</span>
                @elseif($payment->cancelled_at)
                    <span class="text-danger"><i class="fa fa-warning"></i> Płatność odrzucona {{ $payment->cancelled_at }}.
                        @if(!empty($payment->cancel_reason))
                            <br/>Powód: {{ $payment->reason }}
                        @endif
                    </span>
                @else
                    <span>
                        <i class="fa fa-question-circle"></i> Płatność oczekuje na potwierdzenie lub została porzucona.
                        <br/>Płatność rozpoczęta {{ $payment->created_at }}
                    </span>
                @endif
            </td>
            <td>
                @if($payment->hasInvoice())
                    <a href="{{ $payment->invoiceDownloadUrl() }}" class="btn btn-primary" target="_blank">
                        <i class="fa fa-download"></i> Pobierz
                    </a>
                @elseif($payment->invoice_request!==null)
                    @if($payment->invoice_request->refused_at !== null)
                        Odrzucono dnia {{ $payment->invoice_request->refused_at }}
                    @else
                        Weryfikujemy dane. Po potwierdzeniu otrzymasz fakturę mailem lub będzie ona do pobrania w tym
                        miejscu
                    @endif
                @else
                    <a href="{{ url('/payments/'.$payment->id.'/request-invoice') }}" class="btn btn-ivba">Poproś o
                        fakturę</a>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
