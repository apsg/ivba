@extends('layouts.front2')

@section('content')
    <!-- Start Cources Section -->
    <section class="our-cources sub padding-lg">
        <div class="container-xl">
            <div class="row">
                <div class="col-sm-8">
                    <h2>Czego się chcesz dzisiaj nauczyć?</h2>
                </div>
            </div>

            <courses
                    :group="{{ $group->id ?? 'null' }}"
                    container-class="container-xl"
                    card-class="col-md-3"
            ></courses>

        </div>

    </section>
    <!-- End Cources Section -->
@endsection
