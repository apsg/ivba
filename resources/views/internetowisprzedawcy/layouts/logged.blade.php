@extends('layouts.html')

@section('sidebar')
    @include('partials.menu-logged')
@endsection

@section('body')
    <body class="logged @stack('bodyclass')">
    <div @if(request()->path() != 'cart' ) id="app" @endif>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sidebar px-1 position-fixed w-100 pt-5" id="sticky-sidebar">
                    @yield('sidebar')
                </div>
                <div class="col-main pt-5 px-3 w-100" id="main">
                    <div class="d-flex justify-content-between">
                        <div class="top-navbar">
                            @yield('navbar')
                        </div>
                        <div class="d-flex">
                            <form action="{{ url("/logout") }}" method="POST">
                                @csrf
                                <button class="account text-gray border-0" title="Wyloguj się">
                                    <i class="fa fa-2x fa-sign-out"></i>
                                </button>
                            </form>
                            <a href="{{ url('/account') }}" class="account text-center mx-2" title="Moje konto">
                                @include('icons.account')
                            </a>
                        </div>
                    </div>

                    @include('common.errors')

                    @yield('content')

                </div>
            </div>
        </div>
        @stack('modals')

    </div>
@endsection
