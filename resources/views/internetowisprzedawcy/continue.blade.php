@extends('layouts.logged')

@section('title', 'Dziękujemy')

@section('content')
    <section class="page content">
        <div class="container">
            <h1 class="text-center my-5">Dziękuję za zaufanie!</h1>
            <div class="d-flex rounded-50 bg-white">
                <div class="w-50 p-5">
                    <h3 class="mt-3">Kilka słów na wstęp</h3>
                    <p class="text-black font-primary pt-3 pb-3">Zaczynamy podróż do świata E-commerce!</p>
                    <p class="text-black font-primary pb-3">Dziękuję Ci za zaufanie! Razem z zespołem dołożymy wszelkich starań aby doświadczenia z korzystania platformy były na jak najwyższym poziomie a praktyka w niej zawarta przyniosła Ci owocne wyniki.</p>
                    <p class="text-black font-primary">Stale aktualizujemy publikowane kursy i ustalamy strategie na następne materiały. Jeśli masz pomysł co moglibyśmy nowego wprowadzić, śmiało daj nam znać.</p>
                    <div class="d-flex justify-content-end m-5">
                        <img src="{{ asset('/images/internetowisprzedawcy/podpis.png') }}"/>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-7 p-0">
                            <vimeo-video-modal
                                button-text="Rozpocznij samouczek"
                                video-src="https://player.vimeo.com/video/764209544?h=c6db007fe5&title=0&byline=0&portrait=0">
                            </vimeo-video-modal>
                            </div>
                            <div class="col-xl-5 p-0">
                                <a href="{{url('/courses')}}" class="btn btn-secondary-ivba font-size-18 continue-button">Zobacz kursy ></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-50 h-100">
                    <img style="margin-top: -80px" src="{{ asset('/images/internetowisprzedawcy/mati_shadow.png') }}" />
                </div>
            </div>
        </div>
    </section>
@endsection

