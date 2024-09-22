<div class="row justify-content-center">
{{--    <div class="d-none d-md-block col-md-1 p-0">--}}
{{--        zdj tła--}}
{{--    </div>--}}
    <div class="col-12 offset-md-2 col-md-8 join-us-container mx-md-5">
        <div class="p-5 p-md-3 p-lg-5">
            <div class="d-flex flex-column flex-md-row gap-4 align-items-center justify-content-between px-3 px-md-5">
                <div class="order-1 order-md-0">
                    <h2 class="h2-headline text-center text-md-start">
                        Dołcz do <br>
                        <span class="color-red">27.000 osób</span> <br>
                        na iNauka.pl
                    </h2>
                    <div class="d-flex flex-column gap-3">
                        <a href="{{ url('/buy_access') }}" class="d-inline-flex align-items-center btn cta_button font-button btn-coral-lg">
                            <i class="icon-arrow-right white" style="width: 25px; height: 25px"></i>
                            PEŁNY DOSTĘP DO 35 KURSÓW ZA 39 ZŁ/MSC
                        </a>
                        <a href="{{ url('/buy_access') }}" class="d-inline-flex align-items-center btn bg-white cta_button font-button" style="max-width: 250px">
                            <i class="icon-arrow-right coral" style="width: 25px; height: 25px"></i>
                            <span class="color-red">LUB PRZEGLĄDAJ KURSY</span>
                        </a>
                    </div>
                </div>
                <div class="order-0 order-md-1">
                    <dotlottie-player
                            src="{{ url('/images/inauka2/animacja.json') }}"
                            background="transparent" speed="1" style="width: 100%" loop autoplay></dotlottie-player>
                </div>
            </div>


        </div>
    </div>
{{--    <div class="d-none d-md-block col-md-1 p-0">--}}
{{--    img allign to end visible on lg--}}
{{--    </div>--}}
</div>
