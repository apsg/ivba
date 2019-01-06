@extends('layouts.front2')

@section('content')
    <!-- Start Cources Section -->
    <section class="our-cources sub padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <h2>Czego się chcesz dzisiaj nauczyć?</h2>
                </div>
            </div>

            <courses></courses>

            <div class="row">
                <div class="col-sm-12">

                    @if( Auth::check() && Auth::user()->hasFullAccess() )
                        <div class="alert alert-info">Masz już pełen dostęp do wszystkich materiałów</div>
                    @endif

                    @if(!Auth::check())
                        <div class="alert alert-danger">Zaloguj się, aby zobaczyć kursy, do których masz dostęp.</div>
                    @endif

                    @if(!empty($next))
                        <div class="alert alert-info">Dostęp do następnego kursu uzyskasz za następującą liczbę
                            dni: {{ $next }}</div>
                    @endif

                </div>
            </div>
        </div>

    </section>
    <!-- End Cources Section -->
@endsection