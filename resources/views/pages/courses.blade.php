@extends('layouts.front2')

@section('content')
    <!-- Start Cources Section -->
    <section class="our-cources sub padding-lg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <h2><span>Kategorie kursów</span> Czego się chcesz dzisiaj nauczyć?</h2>
                </div>
            </div>
            @if(!empty($courses) && $courses->count() > 0)
                <ul class="row course-list inner">

                    @foreach($courses as $course)
                        <li class="col-xs-6 col-sm-4 col-md-4 ">
                            @include('partials.course_thumb')
                        </li>
                    @endforeach

                    @if(Auth::check() && $next_courses->count() > 0)
                        @foreach($next_courses as $next_course)
                            <li class="col-xs-6 col-sm-4 col-md-4 ">
                                <div class="inner course-thumb-new">
                                    <div class="course-img"
                                         style="background-image: url('{{ $next_course->image->thumb(600, 300) }}');">
                                        <div class="countdown">
                                            @if(Gate::check('active'))
                                                Dostęp do tego kursu uzyskasz za:
                                                <div class="countdown-count">{{ $next_course->real_delay }}</div>
                                                dni
                                            @else
                                                Wykup abonament lub pełen dostęp, by przejść do tego kursu.
                                            @endif
                                        </div>
                                    </div>
                                    <div class="course-info">
                                        <h3>{{ $next_course->title }}</h3>
                                        <p>{{ $next_course->excerpt }}</p>
                                    </div>
                                    <div class="course-meta">
                                        <div class="course-users"><i
                                                    class="fa fa-user-o"></i> {{ $next_course->users_count }}</div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endif

                </ul>
            @else
                <p>Nie masz obecnie dostępu do żadnych kursów. Musisz wykupić lub przedłużyć abonament, by
                    uzyskać dostęp</p>
            @endif
            <div class="row">
                <div class="col-sm-12">
                    <nav aria-label="Page navigation" class="text-center">
                        @if(!empty($courses))
                            {{ $courses->links() }}
                        @endif
                    </nav>
                </div>
            </div>
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