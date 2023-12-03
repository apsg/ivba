<div class="nav flex-column flex-nowrap w-100 overflow-auto text-white p-2 text-center">
    <a href="{{ url('/') }}">
        <img width="43" height="71" src="{{ asset('/images/internetowisprzedawcy/logo_znak.svg') }}">
    </a>

    <ul class="px-0 pt-5 sm-hidden">
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
        <li class="nav-item">
            <a class="nav-link @if(url('/paths') === url()->current()) active @endif" href="{{ url('/paths') }}">
                @include('icons.paths')
                Ścieżki rozwoju
            </a>
        </li>
    </ul>
</div>
