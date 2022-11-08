<ul class="nav navbar-nav">
    @if (Auth::guest())
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}/#o-platformie">O platformie</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}/#korzysci">Korzyści</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}/#opinie">Opinie</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}/#zobacz-kursy">Zobacz kursy</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}/#faq">FAQ</a>
        </li>
    @endif

    @foreach($menu as $item)

        @if($item->url != '/buy_access'
        || Auth::guest()
        || !Auth::user()->hasFullAccess()
        || !Auth::user()->hasActiveSubscription())
            <li class="nav-item">
                <a class="nav-link" href="{{ url($item->url) }}"
                   @if($item->is_new_window) target="_blank" @endif>{{ $item->title }}</a>
            </li>
        @endif
    @endforeach
</ul>
<ul class="ml-auto nav navbar-collapse">
    <!-- Authentication Links -->
    @if (Auth::guest())
        <li class="nav-item ml-auto">
            <a class="nav-link nav-link-header__register" href="{{ url('/buy_access') }}">
                @if(!setting('is.disable_buy'))
                    Wykup dostęp
                @else
                    Zapisz się
                @endif
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-link-header" href="{{ route('login') }}">
                Zaloguj się
                <i class="fa fa-sign-in"></i>
            </a>
        </li>
    @else
        @if(Auth::user()->hasActiveSubscription() || Auth::user()->hasFullAccess())
            <li class="nav-item ml-auto">
                <a class="nav-link" href="{{ url('/buy_access') }}">
                    Przedłuż dostęp
                </a>
            </li>
            <li class="nav-item">
                <a  style="background-color: #00A9A7; border-color: #00A9A7;"
                    class="nav-link nav-link-header nav-link-header__register"
                    href="{{ url('/account/mycourses') }}">
                    Zobacz materiały
                </a>
            </li>
        @else
            <li class="nav-item ml-auto">
                <a class="nav-link nav-link-header__register" href="{{ url('/buy_access') }}">
                    @if(!setting('is.disable_buy'))
                        Wykup dostęp
                    @else
                        Zapisz się
                    @endif
                </a>
            </li>
        @endif
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user"></i> {{ Auth::user()->name }}</a>
            <div class="dropdown-menu" aria-labelledby="dropdown">
                <a href="{{ url('account') }}" class="dropdown-item"><i class="fa fa-user"></i> Moje
                    konto</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i>
                    Wyloguj
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </a>
            </div>
        </li>

        @include('partials.cart_link')

        @if(Gate::allows('admin'))
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/admin/stats') }}"><i class="fa fa-cogs"></i>
                    Administracja</a>
            </li>
        @endif
    @endif
</ul>
