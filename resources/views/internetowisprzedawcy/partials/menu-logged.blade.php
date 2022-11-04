<div class="nav flex-column flex-nowrap w-100 overflow-auto text-white p-2 text-center">
    <a href="{{ url('/') }}">
        <img src="{{ asset('/images/internetowisprzedawcy/logo_znak.png') }}">
    </a>

    <ul class="nav flex-column mb-2 mt-3">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/posts') }}" style="font-size: inherit !important;">
                <i class="fa fa-caret-left"></i>
                Wróć do strony głównej
            </a>
        </li>
    </ul>

    <ul class="px-0 pt-5">
        <li class="nav-item">
            <a class="nav-link @if(url('/account/mycourses') === url()->current()) active @endif"
               href="{{ url('/account/mycourses') }}">
                @include('icons.play')
                Moje kursy
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(url('/courses') === url()->current()) active @endif" href="{{ url('/courses') }}">
                @include('icons.courses')
                Spis kursów
            </a>
        </li>
    </ul>
</div>
