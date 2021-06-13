@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Edytuj dane</li>
@endpush

@section('pagename', 'Prośby o faktury')
@section('pagesubname', 'Edytuj')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <h3>Dane zamówienia:</h3>
                {{ $invoiceRequest->invoicable }}
            </div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Dane użytkownika z bazy danych</h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        @foreach($invoiceRequest->user()->toArray() as $key => $value)
                            <strong>{{$key}}:</strong> {{ $value }} <br/>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Podane dane do faktury</h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('admin.invoice.update', ['invoiceRequest' => $invoiceRequest]) }}"
                              method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label>Kwota</label>
                                <input placeholder="Wpisz swoje imię..."
                                       type="text"
                                       name="final_total"
                                       required="required"
                                       class="form-control"
                                       value="{{ $invoiceRequest->getTotal() }}">
                            </div>

                            <div class="form-group">
                                <label>Nazwa firmy</label>
                                <input placeholder="Wpisz swoje imię..." type="text" name="company_name"
                                       required="required"
                                       class="form-control"
                                       value="{{ $invoiceRequest->user()->company_name }}">
                            </div>

                            <div class="form-group">
                                <label>Adres</label>
                                <input placeholder="Wpisz swój adres zamieszkania..." type="text" name="address"
                                       required="required"
                                       class="form-control" value="{{ $invoiceRequest->user()->address }}">
                            </div>

                            <div class="form-group">
                                <label>NIP </label>
                                <input placeholder="podaj nip" type="text" name="taxid" class="form-control"
                                       value="{{ $invoiceRequest->user()->taxid }}"
                                       required>
                            </div>

                            <div class="form-group">
                                <label>Własny opis pozycji </label>
                                <input placeholder="Własny opis pozycji"
                                       type="text"
                                       name="custom_description"
                                       class="form-control"
                                       value="{{ $invoiceRequest->custom_description }}">
                                <p>
                                    Automatyczne pozycje:
                                    {{ $invoiceRequest->getDescription() }}
                                    @foreach($invoiceRequest->getProducts() as $position)
                                        <br/> {{ $position }}
                                    @endforeach
                                </p>
                            </div>

                            <button class="btn btn-ivba"><i class="fa fa-save"></i> Zapisz i kontynuuj</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
