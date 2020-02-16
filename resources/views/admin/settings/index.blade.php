@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Ustawienia</li>
@endpush

@section('pagename', 'Ustawienia')
@section('pagesubname', 'Zarządzanie')

@section('content')
    <section class="content">
        <div class="row">
            @foreach($list as $key => $description)
                @include('admin.settings.setting')
            @endforeach
        </div>
    </section>
@endsection
