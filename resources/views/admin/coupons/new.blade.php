@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class=""><a href="{{ url('/admin/coupon') }}">Kupony</a></li>
    <li class="active">Dodaj</li>
@endpush

@section('pagename', 'Kupony')
@section('pagesubname', 'Nowe kupony')


@section('content')

    <section class="content row">

        <div class="col-md-6">
            <form action="{{ url('admin/coupon') }}" method="post">
                @include('admin.coupons.coupon_form')
            </form>
        </div>

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3>Groupon</h3>
                    <groupon></groupon>
                </div>
            </div>
        </div>

    </section>
@endsection
