<ul class="nav navbar-nav">
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
            <a class="nav-link nav-link-header nav-link-header__register" href="{{ route('register') }}">Zarejestruj</a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-link-header" href="{{ route('login') }}">Zaloguj się <i class="fa fa-sign-in"></i></a>
        </li>
    @else
        <li class="nav-item dropdown ml-auto">
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
