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
                                <li class="sortable-item" data-course_id="{{ $course->id }}">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <a href="{{ url('/admin/courses/'.$course->slug) }}">
                                                {{ $course->title }}
                                            </a>
                                        </div>
                                        <div class="pl-2">
                                            opóźnienie:
                                            <input type="number" min="0" max="1000" name="delay"
                                                   value="{{ $course->delay }}"
                                                   class="editable"
                                                   data-model="Course"
                                                   data-id="{{ $course->id }}"
                                                   data-col="delay"
                                            /> dni
                                        </div>
                                        <div class="pl-3 d-flex">
                                            <a href="{{ route('admin.course.users', $course) }}"
                                               class="btn btn-sm btn-primary mx-1">
                                                <i class="fa fa-users"></i>
                                            </a>
                                            <a href="{{ route('admin.course.duplicate', $course) }}"
                                               class="btn btn-sm btn-ivba mx-1"
                                               title="Duplikuj">
                                                <i class="fa fa-copy"></i>
                                            </a>
                                            <form method="post" action="{{ route('admin.course.delete', $course) }}">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
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
                                        <button class="btn btn-secondary btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div><!-- /.box-tools -->
                        </div><!-- /.box-header -->
                        <div class="box-body">
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
            $('.sortable').sortable({}).disableSelection();

            $('#courses').on('sortupdate', function (e, ui) {
                updateOrder();
            });
        });

        /**
         * Aktualizuje dane na podstawie kolejności elementów w spisie lekcji przypisanych
         * @return {[type]} [description]
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
