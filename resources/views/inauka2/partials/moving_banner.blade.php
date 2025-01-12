<div class="border border-3 rounded border-color-red row flex-column-reverse flex-md-row px-5 py-3"
     style="background-color: #f7edea;">
    <div class="col-12 col-md-6  text-center text-md-start d-flex flex-column justify-content-center">
        <h2 class="h2-headline text-center text-md-start">
            Dołącz do
        </h2>
        <h2 class="h2-headline color-red  text-center text-md-start">
            27.000 osób
        </h2>
        <h2 class="h2-headline  text-center text-md-start">
            na iNauka.pl
        </h2>
        <div class="text-left">
            <a href="{{ route('buy_access') }}" class="d-inline-flex align-items-center btn cta_button font-button btn-coral-lg">
                <i class="icon-arrow-right white"></i>
                PEŁNY DOSTĘP DO {{ \App\Course::count() }} KURSÓW ZA {{ setting('ivba.subscription_price') }} ZŁ/MSC
            </a>
            <br />
            <a href="{{ route('buy_access') }}" class="d-inline-flex align-items-center btn btn-white cta_button font-button mt-3">
                <i class="icon-arrow-right coral"></i>
                LUB PRZEGLĄDAJ KURSY
            </a>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <dotlottie-player
                src="{{ url('/images/inauka2/animacja.json') }}"
                background="transparent" speed="1" style="width: 100%" loop autoplay></dotlottie-player>
    </div>
</div>
