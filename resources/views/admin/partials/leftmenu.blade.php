<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ auth()->user()->gravatarUrl() }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">NAWIGACJA</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Kokpit</span>
                    <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(request()->is('admin')) active @endif"><a href="{{ url('admin') }}"><i
                                    class="fa fa-circle-o"></i> Start</a></li>
                </ul>
            </li>

            {{-- Zamówienia --}}
            <li class="treeview @if(request()->is('admin/orders*') || request()->is('admin/payments*') || request()->is('admin/quicksales*') ) active @endif">
                <a href="#">
                    <i class="fa fa-shopping-bag"></i> <span>Zamówienia</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(request()->is('admin/orders')) active @endif"><a href="{{ url('admin/orders') }}"><i
                                    class="fa fa-shopping-bag"></i> Zamówienia</a></li>
                    <li class="@if(request()->is('admin/payments')) active @endif"><a
                                href="{{ url('admin/payments') }}"><i class="fa fa-credit-card"></i> Płatności</a>
                    </li>
                    <li class="@if(request()->is('admin/quicksales')) active @endif"><a
                                href="{{ url('admin/quicksales') }}"><i class="fa fa-fighter-jet"></i> Szybka
                            sprzedaż</a>
                    </li>
                </ul>
            </li>
            {{-- k. Zamówienia --}}

            {{-- Strony --}}
            <li class="treeview @if(request()->is('admin/pages*')) active @endif">
                <a href="#">
                    <i class="fa fa-files-o"></i> <span>Strony</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(request()->is('admin/pages')) active @endif"><a href="{{ url('admin/pages') }}"><i
                                    class="fa fa-files-o"></i> wszystkie</a></li>
                    <li class="@if(request()->is('admin/pages/new')) active @endif"><a
                                href="{{ url('admin/pages/new') }}"><i class="fa fa-plus"></i> Dodaj nową</a></li>
                </ul>
            </li>
            {{-- k. Strony --}}

            {{-- Kursy --}}
            <li class="treeview @if(request()->is('admin/courses*') || request()->is('admin/quizzes*')|| request()->is('admin/certificates*')) active @endif">
                <a href="#">
                    <i class="fa fa-institution"></i> <span>Kursy</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(request()->is('admin/courses')) active @endif"><a
                                href="{{ url('admin/courses') }}"><i class="fa fa-files-o"></i> wszystkie</a></li>
                    <li class="@if(request()->is('admin/courses/new')) active @endif"><a
                                href="{{ url('admin/courses/new') }}"><i class="fa fa-plus"></i> Dodaj nowy</a></li>
                </ul>
                <ul class="treeview-menu">
                    <li class="@if(request()->is('admin/quizzes')) active @endif"><a
                                href="{{ url('admin/quizzes') }}"><i class="fa fa-tasks"></i> Testy</a></li>
                    <li class="@if(request()->is('admin/certificates')) active @endif"><a
                                href="{{ url('admin/certificates') }}"><i class="fa fa-graduation-cap"></i> Certyfikaty</a>
                    </li>
                </ul>

            </li>
            {{-- k. kursy --}}


            {{-- Lekcje --}}
            <li class="treeview @if(request()->is('admin/lesson*')) active @endif">
                <a href="#">
                    <i class="fa fa-file-text"></i> <span>Lekcje</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(request()->is('admin/lesson')) active @endif"><a href="{{ url('admin/lesson') }}"><i
                                    class="fa fa-files-o"></i> wszystkie</a></li>
                    <li class="@if(request()->is('admin/lesson/new')) active @endif"><a
                                href="{{ url('admin/lesson/new') }}"><i class="fa fa-plus"></i> Dodaj nową</a></li>
                </ul>
            </li>
            {{-- k. lekcje --}}


            {{-- kupony --}}
            <li class="treeview @if(request()->is('admin/coupon*')) active @endif">
                <a href="#">
                    <i class="fa fa-ticket"></i> <span>kupony</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(request()->is('admin/coupon')) active @endif"><a href="{{ url('admin/coupon') }}"><i
                                    class="fa fa-ticket"></i> wszystkie</a></li>
                    <li class="@if(request()->is('admin/coupon/new')) active @endif"><a
                                href="{{ url('admin/coupon/new') }}"><i class="fa fa-plus"></i> Dodaj nowy</a></li>
                </ul>
            </li>
            {{-- k. kupony --}}


            {{-- Użytkownicy --}}
            <li class="treeview @if(request()->is('admin/user*')) active @endif">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Użytkownicy</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(request()->is('admin/user')) active @endif"><a href="{{ url('admin/user') }}"><i
                                    class="fa fa-users"></i> wszyscy</a></li>
                    {{-- <li class="@if(request()->is('admin/user/new')) active @endif"><a href="{{ url('admin/user/new') }}"><i class="fa fa-plus"></i> Dodaj nowy</a></li> --}}
                </ul>
                <ul class="treeview-menu">
                    <li class="@if(request()->is('admin/user/ranking/all')) active @endif"><a
                                href="{{ url('admin/user/ranking/all') }}"><i
                                    class="fa fa-users"></i> Ranking wszechczasów</a></li>
                </ul>
                <ul class="treeview-menu">
                    <li class="@if(request()->is('admin/user/ranking/month')) active @endif"><a
                                href="{{ url('admin/user/ranking/month') }}"><i
                                    class="fa fa-users"></i> Ranking miesiąca</a></li>
                </ul>
                <ul class="treeview-menu">
                    <li class="@if(request()->is('admin/user/partners')) active @endif"><a
                                href="{{ url('admin/user/partners') }}"><i
                                    class="fa fa-users"></i> Program partnerski</a></li>
                </ul>
            </li>
            {{-- k. Użytkownicy --}}

            {{-- newslettery --}}
            <li class="treeview @if(request()->is('admin/newsletters*') || request()->is('admin/followups*')) active @endif">
                <a href="#">
                    <i class="fa fa-envelope"></i> <span>Newslettery i followupy</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@if(request()->is('admin/newsletters')) active @endif"><a
                                href="{{ url('admin/newsletters') }}"><i class="fa fa-envelope-o"></i> Newslettery</a>
                    </li>
                    <li class="@if(request()->is('admin/newsletters/new')) active @endif"><a
                                href="{{ url('admin/newsletters/new') }}"><i class="fa fa-plus"></i> Dodaj nowy</a></li>

                    <li class="@if(request()->is('admin/followups')) active @endif"><a
                                href="{{ url('admin/followups') }}"><i class="fa fa-envelope-o"></i> Followupy</a></li>
                    <li class="@if(request()->is('admin/followups/new')) active @endif"><a
                                href="{{ url('admin/followups/new') }}"><i class="fa fa-plus"></i> Dodaj nowy</a></li>
                </ul>
            </li>
            {{-- k. newslettery --}}

            {{-- Menu --}}
            <li class="@if(request()->is('admin/menu')) active @endif"><a href="{{ url('admin/menu') }}"><i
                            class="fa fa-bars text-aqua"></i> <span>Menu</span></a></li>

            {{-- k. Menu --}}


            {{-- Menu --}}
            <li class="@if(request()->is('admin/scripts')) active @endif"><a href="{{ url('admin/scripts') }}"><i
                            class="fa fa-code text-aqua"></i> <span>Skrypty</span></a></li>

            {{-- k. Menu --}}

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
