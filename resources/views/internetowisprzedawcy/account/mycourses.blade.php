@extends('layouts.logged')

@section('title', 'Twoje konto')

@section('content')
    <section class="page content px-3">
        <div class="container-fluid">
            @if(!!$lastLesson)
                <h4>Ostatnio przerabiane</h4>
                <div class="bg-white rounded-50 px-5 py-4 d-flex justify-content-between align-content-center align-items-center">
                    <div class="text-gray">
                        Kurs <strong>{{ $lastLesson['course'] }}</strong>.
                        <h4 class="text-black">{{ $lastLesson['lesson'] }}</h4>
                    </div>
                    <div class="">
                        <a href="{{ $lastLesson['url'] }}" class="btn btn-lg btn-ivba ml-5" style="font-size: 1rem">
                            Wróć do lekcji <i class="fa fa-caret-right"></i>
                        </a>
                    </div>
                </div>
            @endif

            <div class="tab-content mt-3 px-5 py-4 rounded-50 bg-white" id="">
                <div class="" id="courses" role="tabpanel" aria-labelledby="courses-tab">

                    @foreach( $user->courses as $course )
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                @if($course->image)
                                    <img style="border-radius: 8px" src="{{ $course->image->thumb(132, 75) }}"/>
                                @endif
                            </div>
                            <div class="flex-fill px-2">Kurs {{ $course->title }}</div>
                            <div class="px-2">
                                <progress-bar slug="{{ $course->slug }}" color="#4da9a9"></progress-bar>
                            </div>
                            <div class="px-2">
                                {{--                                @if(Gate::allows('access', $course))--}}
                                <a class="btn btn-red" href="{{ $course->learnUrl() }}">Przejdź do kursu</a>
                                {{--                                @else--}}
                                {{--                                    Dostęp wygasł--}}
                                {{--                                @endif--}}
                            </div>
                            <div class="px-2">
                                @if( !empty($course->user_certificate) )
                                    <a href="{{ $course->user_certificate->getDownloadUrl() }}">Pobierz</a>
                                @else
                                    Brak certyfikatu
                                @endif
                            </div>
                        </div>
                    @endforeach

                    @include('account.quick_sales')
                </div>
            </div>


        </div>
    </section>
@endsection
