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
                            <div class="notification-mark__container">
                                <a href="{{ url('/posts') }}" class="account text-center mx-2" title="Aktualności">
                                    @include('icons.notification')
                                </a>
                                @if(!Auth::user()->has_seen_posts)
                                    <div class="notification-mark__dot"></div>
                                @endif
                            </div>
                            <div class="btn-group account-menu">
                                <button class="account-menu__main-button" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <a class="account text-center" title="Moje konto">
                                        @include('icons.account')
                                    </a>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item text-center p-2" type="button">
                                        <a href="{{ url('/account') }}">Mój profil</a>
                                    </button>
                                    <hr>
                                    <form action="{{ url("/logout") }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item text-center p-2" type="submit">
                                            <a>
                                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                                Wyloguj
                                            </a>
                                        </button>
                                    </form>
                                </div>
                            </div>
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

@push('scripts')
<!-- <script type="text/javascript">
	$(document).ready(function(){
        let isDropDownTouched = false;
        $('body').on('mouseover', '.account-menu', function(e) { 
            console.log('mouseover')
            $(this).dropdown('show');
        });
        $('body').on('mouseleave', '.account-menu', function(e) {
            setTimeout(() => {
                if (!isDropDownTouched) {
                    $(this).dropdown('hide');
                }
            }, 100);
        });
        $('body').on('mouseover', '.dropdown-menu', function(e) { 
            isDropDownTouched = true;
            $(this).dropdown('hide');
        });
        $('body').on('mouseleave', '.dropdown-menu', function(e) { 
            isDropDownTouched = false;
            $(this).dropdown('hide');
        });
	});
</script> -->
@endpush
