@extends(Auth::check() ? 'layouts.logged' : 'layouts.front2')

@section('content')
    <!-- Start Cources Section -->
    <section class="our-cources sub padding-lg mt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <h2>Czego się chcesz dzisiaj nauczyć?</h2>
                </div>
            </div>
            <courses :ivba="true"></courses>
        </div>
    </section>
    <!-- End Cources Section -->
@endsection
