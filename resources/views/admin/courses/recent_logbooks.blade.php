@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Logbooki</li>
@endpush

@section('pagename', 'Ostatnie logbooki')
@section('pagesubname', 'Kursu')

@section('content')
    <section class="content">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.course.edit', $course) }}">Edycja ustawień</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.course.users', $course) }}">Przegląd uczestników</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('admin.course.logbooks', $course) }}">Ostatnio dodane</a>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ostatnie wpisy w logbookach tego kursu</h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Nazwa</th>
                                <th>Email</th>
                                <th>Logbook</th>
                                <th>Dodano</th>
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
            </div>
        </div>

        <logbook ref="logbook"></logbook>

    </section>
@endsection

@push('scripts')

    <script type="text/javascript">
        $(document).ready(function () {
            $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('admin.course.logbooks.data', $course) }}',
                    'data': function (d) {
                    }
                },
                columns: [
                    {data: 'user.name', name: 'name', searchable: true},
                    {data: 'user.email', name: 'email', searchable: true},
                    {data: 'logbook.title', name: 'title', searchable: false},
                    {data: 'created_at', name: 'created_at', searchable: false},
                    {data: 'options', name: 'options', searchable: false, orderable: false},
                ],
                'iDisplayLength': 25,
                'order': [[2, 'desc']],
            });

            $(document).on('click', '.logbook-open', function (e) {
                window.app.$refs.logbook.open($(this).data('user'), $(this).data('course'));
            });
        });
    </script>

@endpush

