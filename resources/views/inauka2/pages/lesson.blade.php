@extends('layouts.front2')

@section('title', $lesson->seo_title ?? $lesson->title)
@section('seo_description', $lesson->seo_description)

@section('content')
    <!-- Start lesson Description -->
    <section class="about inner padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-md-push-5 left-block">
                    <h2>{{ $lesson->title }}</h2>

                    {!! $lesson->introduction !!}


                </div>
                <div class="col-md-5 col-md-pull-7">
                    <div class="enquire-wrapper">
                        <figure class="hidden-xs hidden-sm">
                            @if(Gate::allows('access-lesson', $lesson))
                                <a href="{{ $lesson->learnUrl() }}">
                                    <img src="{{ $lesson->image->url }}" class="img-responsive" alt="">
                                </a>
                            @else
                                <img src="{{ $lesson->image->url }}" class="img-responsive" alt="">
                            @endif
                        </figure>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="course-detail clearfix">
                        <div class="duration clearfix">
                            <div class="icon"><span class="icon-duration-icon"></span></div>
                            <div class="detail"><span>Czas trwania</span> {{ $lesson->duration }} </div>
                        </div>
                        <div class="duration eligible clearfix">
                            <div class="icon"><span class="icon-certification-icon"></span></div>
                            <div class="detail"><span>Trudność:</span> {{ $lesson->difficulty() }}</div>
                        </div>
                        @if( Gate::allows('access-lesson', $lesson))
                            <a href="{{ url('/learn/lesson/'.$lesson->slug) }}" class="btn btn-primary">Rozpocznij
                                lekcję <span class="icon-more-icon"></span></a>
                        @else
                            Nie masz jeszcze dostępu do tej lekcji. Poczekaj aż uzyskasz dostęp w ramach swojego
                            abonamentu lub wykup pełen dostęp. <br/>
                            <a href="{{ url('/buy_access') }}" class="btn btn-primary">Kup dostęp <span
                                        class="icon-more-icon"></span></a>

                        @endif
                    </div>
                </div>
            </div>
    </section>
    <!-- End lesson Description -->

    <section class="details-tab">
        <div class="container">
        </div>
    </section>

@endsection