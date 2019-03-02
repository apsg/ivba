@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Start</li>
@endpush

@section('pagename', 'Kokpit')
@section('pagesubname', 'Start')


@section('content')


    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <p>Pokaż statystyki
                    <input type="text" name="date_select" id="datepicker">
            </div>
        </div>
        <hr/>
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Zarejestrowanych użytkowników</span>
                        <span class="info-box-number">{{ \App\Helpers\Statistics::countRegisteredUsers() }}<small> użytkowników</small></span>
                        <span class="info-box-number">{{ \App\Helpers\Statistics::countRegisteredUsersInRange($startDate, $endDate) }}<small> w zadanym okresie</small></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-unlock-alt"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Użytkowników z wykupionym dostępem</span>
                        <span class="info-box-number">{{ \Statistics::countPaidUsers() }}</span>
                        <span class="info-box-number">{{ \Statistics::countPaidUsersInRange($startDate, $endDate) }} <small>w zadanym okresie</small></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Zamówienia</span>
                        <span class="info-box-number">{{ \Statistics::countOrders() }} <small>złożonych</small></span>
                        <span class="info-box-number">{{ \Statistics::countConfirmedOrders() }} <small>potwierdzonych</small></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-cart-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Zamówienia w zadanym okresie</span>
                        <span class="info-box-number">{{ \Statistics::countOrdersInRange($startDate, $endDate) }} <small>złożonych</small></span>
                        <span class="info-box-number">{{ \Statistics::countConfirmedOrdersInRange($startDate, $endDate) }} <small>potwierdzonych</small></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Suma płatności</span>
                        <span class="info-box-number">{{ \Statistics::sumPayments() }} <small>PLN łącznie</small></span>
                        <span class="info-box-number">{{ \Statistics::sumPaymentsInRange($startDate, $endDate) }} <small>PLN w zadanym okresie</small></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->

            </div>
            <!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-credit-card"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Liczba subskrypcji</span>
                        <span class="info-box-number">{{ \Statistics::countSubscriptions() }} <small>aktywnych</small></span>
                        <span class="info-box-number">{{ \Statistics::countSubscriptionsInRange($startDate, $endDate) }} <small>wygasających w zadanym okresie</small></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-credit-card"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Suma płatności subskrypcyjnych</span>
                        <span class="info-box-number">{{ \Statistics::sumSubscriptionsPayments() }} <small>PLN łącznie</small></span>
                        <span class="info-box-number">{{ \Statistics::sumSubscriptionsPaymentsInRange($startDate, $endDate) }} <small>PLN w zadanym okresie</small></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- TABLE: LATEST ORDERS -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Najnowszych 10 użytkowników</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>Nazwa</th>
                                    <th>email</th>
                                    <th>Zarejestrowany dnia</th>
                                    <th>Pełen dostęp do dnia</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lastUsers as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->full_access_expires }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <a href="{{ url('admin/user') }}" class="btn btn-sm btn-info btn-flat pull-left">Przejdź do
                            spisu użytkowników</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-6">
                <div class="progress-group">
                    <span class="progress-text">Wysłanych maili</span>
                    <span class="progress-number"><b>{{ \Statistics::countEmailsSent($startDate, $endDate) }}</b></span>

                    <div class="progress sm">
                        <div class="progress-bar progress-bar-aqua" style="width: 100%"></div>
                    </div>
                </div>

                <div class="progress-group">
                    <span class="progress-text">Otwartych maili</span>
                    <span class="progress-number"><b>{{ \Statistics::countEmailsOpened($startDate, $endDate) }}</b>/{{ \Statistics::countEmailsSent($startDate, $endDate) }}</span>

                    <div class="progress sm">
                        <div class="progress-bar progress-bar-green"
                             style="width: {{ \Statistics::procEmailsOpened($startDate, $endDate) }}%"></div>
                    </div>
                </div>

                <div class="progress-group">
                    <span class="progress-text">Klikniętych maili</span>
                    <span class="progress-number"><b>{{ \Statistics::countEmailsClicked($startDate, $endDate) }}</b>/{{ \Statistics::countEmailsSent($startDate, $endDate) }}</span>

                    <div class="progress sm">
                        <div class="progress-bar progress-bar-yellow"
                             style="width: {{ \Statistics::procEmailsClicked($startDate, $endDate) }}%"></div>
                    </div>
                </div>

                <div class="progress-group">
                    <span class="progress-text">Wypisało się</span>
                    <span class="progress-number"><b>{{ \Statistics::countEmailsUnsubscribed($startDate, $endDate) }}</b>/{{ \Statistics::countEmailsSent($startDate, $endDate) }}</span>

                    <div class="progress sm">
                        <div class="progress-bar progress-bar-yellow"
                             style="width: {{ \Statistics::procEmailsUnsubscribed($startDate, $endDate) }}%"></div>
                    </div>
                </div>
            </div>

        </div>
    </section>


@endsection


@push('scripts')

    <script type="text/javascript">
        $(document).ready(function () {
            $("#datepicker").daterangepicker({

                autoUpdateInput: true,
                locale: {
                    format: 'YYYY-MM-DD',
                    firstDay: 1
                },
                startDate: '{{ $startDate }}',
                endDate: '{{ $endDate }}',
            }, function (start, end, label) {
                var s = start.format('YYYY-MM-DD');
                var e = end.format('YYYY-MM-DD');

                window.location = '{{ url()->current() }}?startDate=' + s + '&endDate=' + e;

            });
        });
    </script>

@endpush