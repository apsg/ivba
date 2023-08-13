<ul class="nav navbar-nav ml-auto">

    @foreach($menu as $item)
        @if($item->url != '/buy_access'
        || Auth::guest()
        || !Auth::user()->hasFullAccess()
        || !Auth::user()->hasActiveSubscription())
            <li class="nav-item @if($item->isDropdown()) dropdown @endif">
                <a class="@if($item->isDropdown()) dropdown-toggle @endif nav-link"
                   href="@if($item->isDropdown())#@else {{ url($item->url) }} @endif"
                   @if($item->is_new_window) target="_blank" @endif
                        data-toggle="dropdown"
                >
                    {{ $item->title }}
                </a>
                @if($item->isDropdown())
                    <div class="dropdown-menu">
                        @foreach($item->children as $child)
                            <a href="{{ url($child->url) }}"
                               class="dropdown-item">
                                {{ $child->title }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </li>
        @endif
    @endforeach

    <!-- Authentication Links -->
    @if (Auth::guest())
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}"><i class="fa fa-sign-in"></i>
                Zaloguj</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}"><i class="fa fa-wpforms"></i>
                Zarejestruj</a>
        </li>
    @else
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

        @if(Gate::allows('admin'))
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/admin/stats') }}"><i class="fa fa-cogs"></i>
                    Administracja</a>
            </li>
        @endif

        @include('partials.cart_link')

    @endif
</ul>
