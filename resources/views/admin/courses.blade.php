@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Kursy</li>
@endpush

@section('pagename', 'Kursy')
@section('pagesubname', 'Lista')

@include('admin.partials.medialibrary')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Aktualnie dodane kursy, kolejność i opóźnienie</h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <ul class="sortable" id="courses">
                            @forelse($courses as $course)
                                @include('admin.courses.partials.card')
                            @empty
                                <p>Brak Kursów. Dodaj jakiś.</p>
                                <a href="{{ url('admin/courses/new') }}" class="btn btn-primary">Dodaj kurs</a>
                            @endforelse
                        </ul>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        Przeciągnij kursy by zmienić kolejność
                    </div><!-- box-footer -->
                </div><!-- /.box -->
            </div>
            <div class="col-md-6">
                <h3>Działy</h3>
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Dodaj dział</h3>
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{ route('admin.groups.store') }}">
                            @csrf
                            <input type="text" name="name" required class="form-control">
                            <button type="submit" class="btn btn-primary">
                                Dodaj dział
                            </button>
                        </form>
                    </div>
                </div>
                @foreach($groups as $group)
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ $group->name }}</h3>
                            <div class="box-tools pull-right">
                                <div>
                                    <a href="{{ route('admin.groups.up', $group) }}"
                                       class="btn btn-sm btn-secondary">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a href="{{ route('admin.groups.down', $group) }}"
                                       class="btn btn-sm btn-secondary">
                                        <i class="fa fa-chevron-down"></i>
                                    </a>
                                    <form action="{{ route('admin.groups.destroy', $group) }}"
                                          method="post"
                                          class="inline"
                                    >
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div><!-- /.box-tools -->
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <ul class="sortable groups" id="group{{ $group->id }}" data-group_id="{{ $group->id }}">
                                @foreach($group->courses as $course)
                                    @include('admin.courses.partials.card')
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.sortable').sortable({
                connectWith: '.sortable'
            }).disableSelection();

            $('#courses').on('sortupdate', function (e, ui) {
                updateOrder();
            });

            $('.groups').on('sortupdate', function (e, ui) {
                console.log(e.target);
                console.log($(e.target).children());

                let groupId = $(e.target).data('group_id');
                let order = [];
                $(e.target).children().each(function (id, item) {
                    order.push({
                        course_id: $(item).data('course_id'),
                        position: id
                    })
                });

                console.log(order);

                $.post('{{ route('admin.groups.courses') }}', {
                    _token: '{{ csrf_token() }}',
                    order: order,
                    group: groupId,
                })
            });
        });

        /**
         * Aktualizuje dane na podstawie kolejności elementów w spisie lekcji przypisanych
         */
        function updateOrder() {

            var order = Array();

            $("#courses li").each(function (id, item) {
                order.push({
                    course_id: $(item).data('course_id'),
                    position: id
                });
            });

            $.post('{{ url('/admin/courses_order') }}', {_token: '{{ csrf_token() }}', order: order})
                .done(function (r) {

                });

        }

    </script>
@endpush
