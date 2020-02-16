@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Użytkownicy</li>
@endpush

@section('pagename', 'Użytkownicy')
@section('pagesubname', 'Lista')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Wszyscy użytkownicy</h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Nazwa</th>
                                <th>Email</th>
                                <th>Zarejestrowano dnia</th>
                                <th>Pełen dostęp</th>
                                <th>Subskrypcja</th>
                                <th>Opcje</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>

                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        -
                    </div><!-- box-footer -->
                </div><!-- /.box -->

                <div class="box">
                    <div class="box-header">
                        <h5>Raporty</h5>
                    </div>
                    <div class="box-body">
                        <a href="{{ route('admin.users.expired_report') }}" class="btn btn-primary">
                            Pobierz raport wygasłych kont
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')

    <script type="text/javascript">
        $(document).ready(function () {
            $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ url('/admin/users/data') }}',
                    'data': function (d) {
                    }
                },
                columns: [
                    {data: 'name', name: 'name', searchable: true},
                    {data: 'email', name: 'email', searchable: true},
                    {data: 'created_at', name: 'created_at', searchable: false, orderable: true},
                    {data: 'full_access_expires', name: 'full_access_expires', searchable: false, orderable: true},
                    {data: 'subscription', name: 'subscription', searchable: false, orderable: false},
                    {data: 'options', name: 'options', searchable: false, orderable: false},

                ],
                'iDisplayLength': 10,
                'order': [[2, 'desc']],
            });
        });
    </script>

@endpush
