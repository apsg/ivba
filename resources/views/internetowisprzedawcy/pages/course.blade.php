@extends(Auth::check() ? 'layouts.logged' : 'layouts.front2')

@section('title', $course->seo_title ?? $course->title)

@section('seo_description', $course->seo_description)

@section('content')
    <!-- Start Course Description -->
    <div class="bg-white rounded-50 p-3">
        <section class="about inner padding-lg ">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-md-push-5 left-block">
                        <h2 style="margin-top: 1rem">{{ $course->title }}</h2>

                        {!! $course->description !!}

                    </div>
                    <div class="col-md-5 col-md-pull-7">
                        <div class="enquire-wrapper">
                            <figure class="hidden-xs hidden-sm">
                                @if($course->video()->exists())
                                    {!! $course->video->embed(450, 300) !!}
                                @elseif($course->image)
                                    <img src="{{ $course->image->url }}" class="img-responsive course-img"
                                         alt="course-img">
                                @endif
                            </figure>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="course-detail d-flex align-items-end">
                            <div class="p-3">
                                <div class="icon text-center"><i class="fa fa-clock-o fa-2x"></i></div>
                                <div class="detail"><span>Czas trwania</span> {{ $course->duration() }} </div>
                            </div>
                            <div class="p-3 eligible">
                                <div class="icon text-center">
                                    <i class="fa fa-2x fa-bar-chart-o"></i>
                                </div>
                                <div class="detail"><span>Trudność:</span> {{ $course->difficulty() }}</div>
                            </div>
                            <div class="p-3 eligible">
                                <div class="icon text-center">
                                    <i class="fa fa-2x fa-list-ol"></i>
                                </div>
                                <div class="detail"><span>Liczba lekcji:</span> {{ $course->lessons()->count() }}</div>
                            </div>
                            @if( Gate::allows(\App\Helpers\GateHelper::ACCESS_COURSE, $course))
                                <div style="padding: 1.4rem">

                                    <a href="{{ url('/learn/course/'.$course->slug) }}" class="btn btn-primary">Rozpocznij
                                        kurs
                                        <span class="icon-more-icon"></span></a>
                                </div>
                            @else
                                <div>
                                    Nie masz jeszcze dostępu do tego kursu. Poczekaj aż uzyskasz dostęp w ramach swojego
                                    abonamentu lub wykup pełen dostęp.
                                </div>
                                <div>
                                    <a href="{{ url('/buy_access') }}" class="btn btn-primary">
                                        Kup dostęp
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
        </section>
        <!-- End Course Description -->

        <!-- Start Course Details Tab -->
        <section class="details-tab mt-3">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="curriculum-tab" data-toggle="tab" href="#curriculum"
                                   role="tab"
                                   aria-controls="curriculum" aria-selected="true"><i class="fa fa-list"></i> Spis
                                    treści</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="opinions-tab" data-toggle="tab" href="#opinions" role="tab"
                                   aria-controls="opinions" aria-selected="false"><i class="fa fa-star"></i> Opinie</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="comments-tab" data-toggle="tab" href="#teachers" role="tab"
                                   aria-controls="teachers" aria-selected="false"><i class="fa fa-graduation-cap"></i>
                                    Nauczyciele</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="curriculum" role="tabpanel"
                                 aria-labelledby="curriculam-tab">
                                @include('common.courses.lessons_list')
                            </div>
                            <div class="tab-pane fade" id="opinions" role="tabpanel" aria-labelledby="opinions-tab">
                                <div class="table-responsive">
                                    <table class="table course-table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Oceny</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <h4>Średnia ocena dla tego kursu:</h4>
                                                <span class="rating">{{ $course->avg_rating }}</span>
                                                (ocen: {{ $course->ratings_count }})
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="">
                                                    @include('partials.rating')
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="teachers" role="tabpanel" aria-labelledby="teachers-tab">
                                <div class="row pt-3">
                                    <div class="col-md-4" style="text-align: center;">
                                        <img src="{{ url('images/mati-is.png') }}" alt="" style="width: 100%; max-width: 300px; height: auto;">
                                    </div>
                                    <div class="col-md-8">
                                        <h3>Mateusz Grabowski</h3>
                                        <p>współtwórca jednej z największych platform do sprzedaży w modelu
                                            dropshippingowym – TakeDrop.pl. Z branżą e-commerce związany od 2001 r.
                                            Prowadził kampanie reklamowe dla czołowych w Polsce sklepów. Twórca jednego
                                            z popularniejszych kanałów na YouTube poświęconego tematyce dropshippingu.
                                            Wieloletni wykładowca i człowiek z pasją do sportów ekstremalnych.
                                            Pięciokrotnie startował w zawodach Red Bull 111 MegaWatt, pasjonat sportów
                                            lotniczych.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Course Details Tab -->
    </div>
@endsection
