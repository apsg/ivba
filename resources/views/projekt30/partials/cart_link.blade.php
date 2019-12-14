@auth
    @if(!Auth::user()->getCurrentOrder()->isEmpty())
        <li class="nav-item">
            <a class="nav-link" href="{{url('/cart')}}"><i class="fa fa-shopping-cart"></i>
                Koszyk</a>
        </li>
    @endif
@endauth