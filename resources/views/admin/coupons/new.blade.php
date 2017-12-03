@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class=""><a href="{{ url('/admin/coupon') }}">Kupony</a></li>
    <li class="active">Nowy</li>
@endpush

@section('pagename', 'Kupony')
@section('pagesubname', 'Nowy kupon')


@section('content')

<section class="content">
	<form action="{{ url('admin/coupon') }}" method="post">
		@include('admin.coupons.coupon_form')
	</form>
</section>
@endsection
