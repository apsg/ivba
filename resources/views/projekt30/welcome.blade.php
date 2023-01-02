@extends('layouts.front2')

@section('title', 'Projekt30 - kompleksowe szkolenia z e-marketingu')

@section('content')
    <section class="container" style="min-height: 100vh;">
        <div class="row">
            <div class="col-12 my-5 py-5">
                <div class="d-flex justify-content-between align-middle">
                    <div>
                        <img src="{{ asset('/images/internetowisprzedawcy/logo.png') }}" />
                    </div>
                    <div class="mb-5">
                        <a class="btn btn-p30-red btn-lg p-3"
                           style="border-radius: 7px; box-shadow: 0px 10px 30px #E7323B48;"
                           href="https://internetowisprzedawcy.pl">
                            Dowiedz się więcej
                            <i class="fa fa-search ml-3"></i>
                        </a>
                    </div>
                </div>
                <div class="text-left">
                    <p style="font-size: 16px;"><span style="color:#00A9A7">✓</span> Pełny dostęp do zaawansowanych <a href="https://internetowisprzedawcy.pl/courses">kursów z E-commerce</a></p>
                    <p style="font-size: 16px;"><span style="color:#00A9A7">✓</span> Dedykowane miejsce na bieżące aktualności i porady o sprzedaży w Internecie</p>
                    <p style="font-size: 16px;"><span style="color:#00A9A7">✓</span> Ćwiczenia, schematy i cykliczne raporty z postępów w wdrażaniu rozwiązań</p>
                    <p style="font-size: 16px;"><span style="color:#00A9A7">✓</span> Dedykowane forum integrujące społeczność Internetowych sprzedawców</p>
                </div>

                <hr class="my-5" />
                <div>
                    Masz konto na projekt30.pl - możesz się zalogować tu
                    <a href="{{ url('/login') }}" class="btn btn-ivba">Zaloguj się</a>
                </div>
            </div>
        </div>
    </section>

@endsection
