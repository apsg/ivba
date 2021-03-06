@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Kody rabatowe</li>
@endpush

@section('pagename', 'Kupony')
@section('pagesubname', 'Lista')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Wszystkie kody rabatowe</h3>
                        <div class="box-tools pull-right">
                            {{ $coupons->links() }}
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Kod</th>
                                <th>Typ</th>
                                <th>Wartość</th>
                                <th>Pozostało użyć</th>
                                <th>Opcje</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($coupons as $coupon)
                                <tr>
                                    <td>{{ $coupon->code }}</td>
                                    <td>{{ $coupon->type_text }}</td>
                                    <td>{{ nl2br($coupon->valueFormatted()) }}</td>
                                    <td>{{ $coupon->uses_left }}</td>
                                    <td>
                                        <a href="{{ $coupon->editLink() }}" class="btn btn-primary"><i
                                                    class="fa fa-edit"></i> Edytuj </a>
                                        <a href="{{ $coupon->deleteLink() }}" class="btn btn-danger"
                                           onclick="return confirm('Czy na pewno chcesz usunąć ten element?');"><i
                                                    class="fa fa-trash"></i> Usuń </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        {{ $coupons->links() }}
                    </div><!-- box-footer -->
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@endsection