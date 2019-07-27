@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Faktury</li>
@endpush

@section('pagename', 'Prośby o faktury')
@section('pagesubname', 'Lista')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Wszystkie Prośby o faktury</h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Użytkownik</th>
                                <th>email</th>
                                <th>Dane</th>
                                <th>Data</th>
                                <th>Zamówienie</th>
                                <th>Kwota</th>
                                <th>Akcje</th>
                            </tr>
                            </thead>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->order->user->name }}</td>
                                    <td>{{ $invoice->order->user->email }}</td>
                                    <td>
                                        Imię: {{ $invoice->order->user->first_name }} <br>
                                        Nazwisko: {{ $invoice->order->user->last_name }}<br>
                                        Adres: {{ $invoice->order->user->address }}<br>
                                        NIP: {{ $invoice->order->user->taxid }}<br>
                                    </td>
                                    <td>{{ $invoice->created_at }}</td>
                                    <td>{{ $invoice->order->getDescription() }}</td>
                                    <td>{{ $invoice->order->total() }} PLN</td>
                                    <td>
                                        <a href="{{ route('admin.invoice.accept', $invoice->id) }}" class="btn btn-primary">
                                            <i class="fa fa-check"></i> Zatwierdź
                                        </a>
                                        <a href="{{ route('admin.invoice.reject', $invoice->id) }}" class="btn btn-danger">
                                            <i class="fa fa-times"></i> Odrzuć
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            <tbody>
                            </tbody>

                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        -
                    </div><!-- box-footer -->
                </div><!-- /.box -->
            </div>
        </div>
    </section>

@endsection
