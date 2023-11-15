<ul class="nav navbar-nav ml-auto">

    @foreach($menu as $item)
        @if($item->url != '/buy_access'
        || Auth::guest()
        || !Auth::user()->hasFullAccess()
        || !Auth::user()->hasActiveSubscription())
            @if($item->isDropdown())
                <li class="nav-item dropdown py-1 px-2">
                    <a class="dropdown-toggle nav-link"
                       href="#"
                       data-toggle="dropdown"
                    >
                        {{ $item->title }}
                    </a>
                    <div class="dropdown-menu">
                        @foreach($item->children as $child)
                            <a href="{{ url($child->url) }}"
                               class="dropdown-item">
                                {{ $child->title }}
                            </a>
                        @endforeach
                    </div>
                </li>
            @else
                <li class="nav-item py-1 px-2">
                    <a class="nav-link"
                       href="{{ url($item->url) }}"
                       @if($item->is_new_window) target="_blank" @endif
                    >
                        {{ $item->title }}
                    </a>
                </li>
            @endif
        @endif
    @endforeach

    <!-- Authentication Links -->
    @if (Auth::guest())
        <li class="nav-item py-1 px-2">
            <a class="nav-link d-flex align-items-center justify-content-center" href="{{ route('login') }}">
                <span class="material-symbols-outlined font-size-18" style="margin-bottom: 2px">login</span>
                Zaloguj
            </a>
        </li>
        <li class="nav-item nav-green-border px-3 py-1 ml-2">
            <a class="nav-link d-flex align-items-center justify-content-center" href="{{ route('register') }}">
                <span class="material-symbols-outlined font-size-18">app_registration</span>
                Zarejestruj
            </a>
        </li>
    @else
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="material-symbols-outlined font-size-16">person</span> {{ Auth::user()->name }}</a>
            <div class="dropdown-menu" aria-labelledby="dropdown">
                <a href="{{ url('account') }}" class="dropdown-item">
                    <span class="material-symbols-outlined font-size-16">person</span>
                    Moje konto
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <span class="material-symbols-outlined font-size-16">logout</span>
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
