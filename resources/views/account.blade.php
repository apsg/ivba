@extends('layouts.front2')

@section('title', 'Twoje konto')

@section('content')
    <section class="page content">
        <div class="container">
            <h1>Twoje konto</h1>
            <hr/>

            @if(!!$lastLesson)
                <div class="alert alert-info">
                    Ostatnio realizowana lekcja: <strong>{{ $lastLesson['lesson'] }}</strong>
                    w kursie: <strong>{{ $lastLesson['course'] }}</strong>.
                    <a href="{{ $lastLesson['url'] }}" class="btn btn-ivba ml-5">Kontynuuj naukę</a>

                </div>
                <hr/>
            @endif

            <ul class="nav nav-tabs nav-pills nav-justified" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="ranking-tab" data-toggle="tab" href="#ranking" role="tab"
                       aria-controls="ranking" aria-selected="true">Ranking</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="courses-tab" data-toggle="tab" href="#courses" role="tab"
                       aria-controls="courses" aria-selected="true">Kursy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                       aria-controls="profile" aria-selected="false">Dane</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="finance-tab" data-toggle="tab" href="#finance" role="tab"
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
                            <th>Data ukończenia</th>
                            <th>Link</th>
                            <th>Pobierz certyfikat</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $user->courses as $course )
                            <tr>
                                <th scope="row">{{ $course->title }}</th>
                                <td>{{ $course->pivot->created_at }}</td>
                                <td>{{ $course->pivot->finished_at }}</td>
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

                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row">
                        <div class="col-md-6">
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
                                    <p>Ta nazwa używana jest na certyfikatach, które są wystawiane po niektórych z
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
                                    <p>Kliknij poniższy przycisk, aby zmienić hasło. Wyślemy do Ciebie maila, dzięki
                                        któremu
                                        zmienisz swoje hasło.</p>
                                    <p>Po kliknięciu w poniższy przycisk nastąpi automatyczne wylogowanie. Odszukaj w
                                        swojej
                                        skrzynce naszą wiadomość i zmień hasło.</p>
                                    <button type="submit" class="btn btn-ivba">Zmień hasło</button>
                                </div>
                            </form>


                        </div>
                    </div>

                    <hr/>
                    <h3>Twoje dane rozliczeniowe:</h3>
                    @include('partials.user_details_form')</div>
                <div class="tab-pane fade" id="finance" role="tabpanel" aria-labelledby="finance-tab"><h3>Twoje dostępy
                        i subskrypcje</h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Dostęp do</th>
                            <th>Data rozpoczęcia</th>
                            <th>Wygasa/następna płatność</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if( !is_null(\Auth::user()->full_access_expires) )
                            <tr>
                                <th scope="row">Pełen dostęp do platformy iNauka</th>
                                <td>-</td>
                                <td>{{ $user->full_access_expires }}</td>
                                <td>
                                    @if($user->full_access_expires->isPast())
                                        <i class="fa fa-minus-circle text-danger"></i> Wygasł
                                    @else
                                        <i class=" fa fa-check text-success"></i> Aktywny
                                    @endif
                                </td>
                            </tr>
                        @endif
                        @foreach( $user->subscriptions as $subscription )
                            <tr>
                                <th scope="row">
                                    Subskrypcja - abonament miesięczny
                                </th>
                                <td>{{ $subscription->created_at->format('Y-m-d') }}</td>
                                <td>
                                    {{ $subscription->valid_until }}
                                </td>
                                <td>
                                    @if(!$subscription->is_active)
                                        <i class="fa fa-minus-circle text-danger"></i>Anulowana lub niepotwierdzona
                                    @else
                                        @if($subscription->cancelled_at)
                                            <i class="fa fa-minus-circle text-danger"></i> Zakończono - anulowana
                                        @else
                                            <i class="fa fa-check text-success"></i> Aktywna
                                            <a href="{{ url('/subscription/'.$subscription->id.'/cancel') }}"
                                               class="btn btn-danger btn-sm confirm"><i class="fa fa-times"></i> Anuluj</a>
                                        @endif
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                        @if($user->remaining_days > 0)
                            <tr>
                                <th colspan="3" scope="row" class="text-right"><strong>Pozostało aktywnych dni na tym
                                        koncie:</strong></th>
                                <td>
                                    <strong class="text-success">{{ $user->remaining_days }}</strong>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                    <hr/>
                    <h3>Twoje Płatności</h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Kod płatności</th>
                            <th>Opis</th>
                            <th>Kwota PLN</th>
                            <th>Opłacono</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user->confirmedOrders() as $order)
                            <tr>
                                <th scope="row">{{ $order->id }}</th>
                                <td>{{ $order->payu_order_id ?? $order->id }}</td>
                                <td>{{ $order->description }}</td>
                                <td>{{ $order->final_total }}</td>
                                <td>{{ $order->confirmed_at }}</td>
                            </tr>
                        @endforeach
                        @foreach($payments as $payment)
                            <tr>
                                <th scope="row">{{ $payment->id }}</th>
                                <td>{{ $payment->id }}</td>
                                <td>
                                    {{ $payment->title }}<br/>
                                    @if($payment->is_recurrent)
                                        <span class="text-info"><i
                                                    class="fa fa-info"></i> Automatyczna płatność miesięczna</span>
                                    @else
                                        <span class="text-info"><i
                                                    class="fa fa-info"></i> Pierwsza płatność w abonamencie</span>
                                    @endif
                                </td>
                                <td>{{ $payment->amount }}</td>
                                <td>
                                    @if($payment->confirmed_at)
                                        <span class="text-success"><i class="fa fa-check"></i> Płatność zrealizowana {{ $payment->confirmed_at }}</span>
                                    @elseif($payment->cancelled_at)
                                        <span class="text-danger"><i class="fa fa-warning"></i> Płatność odrzucona {{ $payment->cancelled_at }}.
                                    @if(!empty($payment->cancel_reason))
                                                <br/>Powód: {{ $payment->reason }}
                                            @endif
                                </span>
                                    @else
                                        <span>
                                    <i class="fa fa-question-circle"></i> Płatność oczekuje na potwierdzenie lub została porzucona.
                                    <br/>Płatność rozpoczęta {{ $payment->created_at }}
                                </span>
                                    @endif


                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </section>
@endsection