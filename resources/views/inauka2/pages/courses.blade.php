@extends('layouts.front')

@section('content')
    <!-- Start Courses Section -->
    <section class="our-cources sub padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <h2>Czego się chcesz dzisiaj nauczyć?</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-gray">
            <courses :groups="{{ $groups }}"></courses>
    </section>

    <!-- End Courses Section -->
@endsection
