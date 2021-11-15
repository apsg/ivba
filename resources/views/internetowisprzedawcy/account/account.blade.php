@extends('layouts.logged')

@section('title', 'Twoje konto')

@section('content')
    <section class="page content px-3">
        <div class="container-fluid bg-white rounded-50 p-4">
            <h4 class="text-gray">Twoje konto</h4>
            <h1 class="mb-5">{{ $user->name }}</h1>

            <ul class="nav nav-tabs nav-pills nav-justified" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active pb-3" id="ranking-tab" data-toggle="tab" href="#ranking" role="tab"
                       aria-controls="ranking" aria-selected="true">Ranking</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pb-3" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                       aria-controls="profile" aria-selected="false">Dane</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pb-3" id="finance-tab" data-toggle="tab" href="#finance" role="tab"
                       aria-controls="finance" aria-selected="false">Finanse</a>
                </li>
            </ul>
            <div class="tab-content mt-3" id="myTabContent">
                <div class="tab-pane fade show active" id="ranking" role="tabpanel" aria-labelledby="ranking-tab">
                    <ranking-user></ranking-user>
                </div>
                <div class="tab-pane fade" id="courses" role="tabpanel" aria-labelledby="courses-tab">
                    <h3>Twoje kursy</h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Kurs</th>
                            <th>Data rozpoczęcia</th>
                            <th>Postęp</th>
                            <th>Link</th>
                            <th>Pobierz certyfikat</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $user->courses as $course )
                            <tr>
                                <th scope="row">{{ $course->title }}</th>
                                <td>{{ $course->pivot->created_at }}</td>
                                <td>
                                    <progress-bar slug="{{ $course->slug }}"></progress-bar>
                                </td>
                                <td>
                                    @if(Gate::allows('access', $course))
                                        <a href="{{ $course->learnUrl() }}">Przejdź do kursu</a>
                                    @else
                                        Dostęp wygasł
                                    @endif
                                </td>
                                <td>
                                    @if( !empty($course->user_certificate) )
                                        <a href="{{ $course->user_certificate->getDownloadUrl() }}">Pobierz</a>
                                    @else
                                        Brak certyfikatu
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @include('account.quick_sales')
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Login</h5>
                            <form action="{{ url('/account') }}" method="post">
                                {{ csrf_field() }}
                                <fieldset disabled>
                                    <div class="form-group">
                                        <label for="disabledTextInput">Adres email:</label>
                                        <input type="text" id="disabledTextInput" class="form-control"
                                               placeholder="Disabled input" value="{{ $user->email }}">
                                    </div>
                                </fieldset>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nazwa użytkownika</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                           aria-describedby="emailHelp" placeholder="Enter email"
                                           value="{{ $user->name }}">
                                    <p class="font-size-10">Ta nazwa używana jest na certyfikatach, które są wystawiane
                                        po niektórych z
                                        kursów.
                                        Najlepiej więc, by znajdowało się tu Twoje imię i nazwisko.</p>
                                </div>
                                <button type="submit" class="btn btn-ivba">Zapisz</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <h3>Zmień hasło</h3>

                            <form action="{{ url('/account/change_password') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <p class="font-size-12">Kliknij poniższy przycisk, aby zmienić hasło. Wyślemy do
                                        Ciebie maila, dzięki
                                        któremu
                                        zmienisz swoje hasło.</p>
                                    <p class="font-size-12">Po kliknięciu w poniższy przycisk nastąpi automatyczne
                                        wylogowanie. Odszukaj w
                                        swojej
                                        skrzynce naszą wiadomość i zmień hasło.</p>
                                    <button type="submit" class="btn btn-red">Zmień hasło</button>
                                </div>
                            </form>


                        </div>
                    </div>

                    <hr/>
                    @include('partials.user_details_form')</div>

                <div class="tab-pane fade" id="finance" role="tabpanel" aria-labelledby="finance-tab">

                    @include('account.accesses')

                    <hr/>
                    @include('account.payments')
                </div>
            </div>


        </div>
    </section>
@endsection
