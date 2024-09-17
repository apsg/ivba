@extends('layouts.front')

@section('content')
    <!-- Start Cources Section -->
    <section class="our-cources sub padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <h2>Czego się chcesz dzisiaj nauczyć?</h2>
                </div>
            </div>

            <courses :groups="{{ $groups }}"></courses>

        </div>

    </section>
    <!-- End Cources Section -->
@endsection
