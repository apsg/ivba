@extends('layouts.logged')

@section('title', 'Twoje konto')

@section('content')
    <section class="page content px-3">
        <div class="container-fluid bg-white rounded-50 p-4">
            <h4 class="text-black text-center mb-5">Ścieżki rozwoju</h4>

            <div class="d-flex justify-content-around">
                <div class="w-25">
                    <div class="square px-1">
                        <div class="circle-border mx-1  d-flex flex-column justify-content-center">
                            <h5 class="text-center text-red">Początkujący</h5>
                        </div>
                    </div>
                    <div class="text-center ">
                        @if(Auth::user()->hasStartedCourseBySlug(setting('is.path_simple')))
                            <div class="mt-5 font-size-18">
                                Postęp
                                <progress-bar slug="{{ setting('is.path_simple') }}" color="#00ACAA"></progress-bar>
                            </div>
                            <div class="text-center mt-5">
                                <a href="{{ route('learn.index', setting('is.path_simple')) }}"
                                   class="btn btn-lg btn-red">
                                    Kontynuuj
                                </a>
                            </div>
                        @else
                            <div class="text-center mt-5">
                                <a href="{{ route('learn.index', setting('is.path_simple')) }}"
                                   class="btn btn-lg btn-gray">Rozpocznij</a>
                            </div>
                            <hr class="mx-5 my-5"/>
                            <h5 class="mb-4">To ścieżka dla osób:</h5>
                            <p class="font-size-14 text-black">Nie mających doświadczenia w IT/E-commerce</p>
                            <p class="font-size-14 text-black">Które nie mają własnego sklepu</p>
                            <p class="font-size-14 text-black">Zaczynają sprzedaż w Internecie</p>
                            <p class="font-size-14 text-black">Powracają do E-commerce</p>
                        @endif
                    </div>
                </div>
                <div class="w-25">
                    <div class="square px-1">
                        <div class="circle-border mx-1">
                            <div class="square__inner">
                                <div class="circle-border__inner d-flex flex-column justify-content-center">
                                    <h5 class="text-center text-red">Średnio<br/>zaawansowany</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center ">
                        @if(Auth::user()->hasStartedCourseBySlug(setting('is.path_medium')))
                            <div class="mt-5 font-size-18">
                                Postęp
                                <progress-bar slug="{{ setting('is.path_medium') }}" color="#00ACAA"></progress-bar>
                            </div>
                            <div class="text-center mt-5">
                                <a href="{{ route('learn.index', setting('is.path_medium')) }}"
                                   class="btn btn-lg btn-red">
                                    Kontynuuj
                                </a>
                            </div>
                        @else
                            <div class="text-center mt-5">
                                <a href="{{ route('learn.index', setting('is.path_medium')) }}"
                                   class="btn btn-lg btn-gray">Rozpocznij</a>
                            </div>
                            <hr class="mx-5 my-5"/>
                            <h5 class="mb-4">To ścieżka dla osób:</h5>
                            <p class="font-size-14 text-black">Posiadających swój sklep</p>
                            <p class="font-size-14 text-black">Które uruchomiły kampanie reklamową</p>
                            <p class="font-size-14 text-black">Które chcą poprawić sprzedaż</p>
                            <p class="font-size-14 text-black">Które chcą zdobyć umiejętności E-commerce</p>
                        @endif
                    </div>
                </div>
                <div class="w-25">
                    <div class="square px-1">
                        <div class="circle-border mx-1 ">
                            <div class="square__inner">
                                <div class="circle-border__inner">
                                    <div class="square__inner">
                                        <div class="circle-border__inner d-flex flex-column justify-content-center">
                                            <h5 class="text-center text-red">Ekspert</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center ">
                        @if(Auth::user()->hasStartedCourseBySlug(setting('is.path_hard')))
                            <div class="mt-5 font-size-18">
                                Postęp
                                <progress-bar slug="{{ setting('is.path_hard') }}" color="#00ACAA"></progress-bar>
                            </div>
                            <div class="text-center mt-5">
                                <a href="{{ route('learn.index', setting('is.path_hard')) }}"
                                   class="btn btn-lg btn-red">
                                    Kontynuuj
                                </a>
                            </div>
                        @else
                            <div class="text-center mt-5">
                                <a href="{{ route('learn.index', setting('is.path_hard')) }}"
                                   class="btn btn-lg btn-gray">Rozpocznij</a>
                            </div>
                            <hr class="mx-5 my-5"/>
                            <h5 class="mb-4">To ścieżka dla osób:</h5>
                            <p class="font-size-14 text-black">Posiadających kilka sklepów</p>
                            <p class="font-size-14 text-black">Prowadzą kampanie nie tylko na 1 platformie</p>
                            <p class="font-size-14 text-black">Mają więcej niż 200 sprzedaży/msc</p>
                            <p class="font-size-14 text-black">Są zaawansowani w E-commerce</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
