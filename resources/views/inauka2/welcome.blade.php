@extends('layouts.front')

@section('title', 'Wideo kursy i konferencje  z Excel, Power BI, Photoshop, Prezentacji.')

@section('content')

    @include('layouts._carousel-nav')

    <!-- Learn online courses -->
    <div class="container-fluid learn-online-container">
        <div class="">
            <img class="" src="{{ url('/images/inauka2/orange-big-arrow.svg') }}" alt=""/>
        </div>
        <div class="container">
            <div class="d-flex justify-content-start align-items-center flex-column flex-md-row px-3 px-md-5 gap-4 gap-md-5">
                <div class="order-0 order-md-1">
                    <img class="w-100 mb-5" style="max-height: 232px" src="{{ url('/images/inauka2/illustracja_kursy.png') }}"/>
                </div>
                <div class="order-1 order-md-0">
                    <h2 class="mb-3">Ucz się online na kursach dostosowanych do Twoich potrzeb.</h2>
                    <p>Znajdź kursy na iNauka, które pomogą Ci rozwinąć umiejętności w wybranej dziedzinie. Dołącz do naszej społeczności i zdobywaj certyfikaty uznawane przez pracodawców.</p>
                </div>
            </div>
        </div>
    </div>

    <courses :groups="{{ $groups }}">
        <div class="d-flex flex-row justify-content-end align-items-center gap-2">
            <div style="max-width: 150px;">
                <img class="w-100 h-auto" src="/images/inauka2/programs-icons.png" alt="programs icons"/>
            </div>

            <a class="d-inline-flex align-items-center btn cta_button font-button btn-coral-lg" href="{{ url('/buy_access') }}">
                <i class="icon-arrow-right white"></i>
                ODBLOKUJ PEŁNY DOSTĘP
            </a>
        </div>
    </courses>

    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing " style="margin-top: 20rem">

        <!-- Three columns of text below the carousel -->
        <div class="row">
            <div class="col-lg-4">
                <svg class="bd-placeholder-img rounded-circle" width="140" height="140"
                     xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder"
                     preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                    <rect width="100%" height="100%" fill="var(--bs-secondary-color)"/>
                </svg>
                <h2 class="fw-normal">Heading</h2>
                <p>Some representative placeholder content for the three columns of text below the carousel. This is the
                    first column.</p>
                <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <svg class="bd-placeholder-img rounded-circle" width="140" height="140"
                     xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder"
                     preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                    <rect width="100%" height="100%" fill="var(--bs-secondary-color)"/>
                </svg>
                <h2 class="fw-normal">Heading</h2>
                <p>Another exciting bit of representative placeholder content. This time, we've moved on to the second
                    column.</p>
                <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <svg class="bd-placeholder-img rounded-circle" width="140" height="140"
                     xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder"
                     preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                    <rect width="100%" height="100%" fill="var(--bs-secondary-color)"/>
                </svg>
                <h2 class="fw-normal">Heading</h2>
                <p>And lastly this, the third column of representative placeholder content.</p>
                <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->


        <!-- START THE FEATURETTES -->

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading fw-normal lh-1">First featurette heading. <span
                            class="text-body-secondary">It’ll blow your mind.</span></h2>
                <p class="lead">Some great placeholder content for the first featurette here. Imagine some exciting
                    prose here.</p>
            </div>
            <div class="col-md-5">
                <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500"
                     height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500"
                     preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                    <rect width="100%" height="100%" fill="var(--bs-secondary-bg)"/>
                    <text x="50%" y="50%" fill="var(--bs-secondary-color)" dy=".3em">500x500</text>
                </svg>
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7 order-md-2">
                <h2 class="featurette-heading fw-normal lh-1">Oh yeah, it’s that good. <span
                            class="text-body-secondary">See for yourself.</span></h2>
                <p class="lead">Another featurette? Of course. More placeholder content here to give you an idea of how
                    this layout would work with some actual real-world content in place.</p>
            </div>
            <div class="col-md-5 order-md-1">
                <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500"
                     height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500"
                     preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                    <rect width="100%" height="100%" fill="var(--bs-secondary-bg)"/>
                    <text x="50%" y="50%" fill="var(--bs-secondary-color)" dy=".3em">500x500</text>
                </svg>
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading fw-normal lh-1">And lastly, this one. <span class="text-body-secondary">Checkmate.</span>
                </h2>
                <p class="lead">And yes, this is the last block of representative placeholder content. Again, not really
                    intended to be actually read, simply here to give you a better view of what this would look like
                    with some actual content. Your content.</p>
            </div>
            <div class="col-md-5">
                <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500"
                     height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500"
                     preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                    <rect width="100%" height="100%" fill="var(--bs-secondary-bg)"/>
                    <text x="50%" y="50%" fill="var(--bs-secondary-color)" dy=".3em">500x500</text>
                </svg>
            </div>
        </div>

        <hr class="featurette-divider">

        <!-- /END THE FEATURETTES -->

    </div><!-- /.container -->

@endsection
