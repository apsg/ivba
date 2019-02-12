@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Płatności</li>
@endpush

@section('pagename', 'Płatności')
@section('pagesubname', 'Lista')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Wszystkie płatności w subskrypcjach</h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Data</th>
                                <th>Typ</th>
                                <th>Subskrypcja</th>
                                <th>Użytkownik</th>
                                <th>Kwota</th>
                                <th>Potwierdzono</th>
                                <th>Anulowano</th>
                                <th>Powód</th>
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
                    url: '{{ url('/admin/payments/data') }}',
                    'data': function (d) {
                    }
                },
                columns: [
                    {data: 'id', name: 'id', searchable: true},
                    {data: 'created_at', name: 'created_at', searchable: true, orderable: true},
                    {data: 'type', name: 'is_recurrent', searchable: false, orderable: true},
                    {data: 'subscription', name: 'subscription', searchable: false, orderable: false},
                    {data: 'user', name: 'user', searchable: false, orderable: false},
                    {data: 'amount', name: 'amount', searchable: false, orderable: true},
                    {data: 'confirmed_at', name: 'confirmed_at', searchable: false, orderable: true},
                    {data: 'cancelled_at', name: 'cancelled_at', searchable: false, orderable: true},
                    {data: 'reason', name: 'reason', searchable: false, orderable: false},
                ],
                'iDisplayLength': 10,
                'order': [[1, 'desc']],
            });
        });
    </script>
@endpush