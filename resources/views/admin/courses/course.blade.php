@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class=""><a href="{{ url('/admin/courses') }}">Kursy</a></li>
    <li class="active">Kurs #{{ $course->id }}</li>
@endpush

@section('pagename', 'Kursy')
@section('pagesubname', $course->title)

@include('admin.partials.medialibrary')
@include('admin.partials.videolibrary')

@section('content')

    @include('admin.partials.course_errors')

    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Edycja</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="box-body">
                <form action="{{ url('admin/courses/'.$course->slug) }}" method="post">
                    {{ method_field('patch') }}
                    @include('admin.partials.course_form')
                </form>
            </div>
            @if(!empty($course))
                <div class="box-body">
                    <form action="{{ url('admin/courses/'.$course->slug) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button class="btn btn-danger pull-right" onclick="return confirm('Na pewno usunąć?');">Usuń
                            kurs
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Przypisz lekcje do kursu</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Dostępne lekcje</h3>
                    </div>
                    <div class="box-body">
                        <ul class="sortable" id="lessons-availible">
                            @foreach( \App\Lesson::except($course->id)->orderBy('created_at', 'desc')->get() as $lesson )
                                <li class="sortable-item" data-lesson-id="{{ $lesson->id }}">{{ $lesson->title }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-md-6">

                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Przypisane lekcje i kolejność</h3>
                    </div>
                    <p class="ml-3">Opóźnienie liczone jest w godzinach od podanej daty rozpoczęcia kursu.</p>
                    <div class="box-body">
                        <ul class="sortable" id="lessons-assigned">
                            @foreach($course->lessons as $lesson)
                                <li class="sortable-item d-flex justify-content-between"
                                    data-lesson-id="{{ $lesson->id }}">
                                    <div>{{ $lesson->title }}</div>
                                    <div>
                                        Opóźnienie [dni]
                                        <input type="number"
                                               class="delay w-25" min="0" step="1" name="delay"
                                               data-lesson-id="{{ $lesson->id }}"
                                               value="{{ $lesson->pivot->delay }}"/>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
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

            $('#lessons-assigned').on('sortupdate', function (e, ui) {
                updateOrder();
            });

            $('.delay').change(function () {
                $.post('{{ url('/admin/courses/'.$course->slug.'/delays') }}', {
                    _token: '{{ csrf_token() }}',
                    lesson_id: $(this).data('lesson-id'),
                    delay: $(this).val()
                });
            });
        });

        /**
         * Aktualizuje dane na podstawie kolejności elementów w spisie lekcji przypisanych
         * @return {[type]} [description]
         */
        function updateOrder() {

            var order = Array();

            $("#lessons-assigned li").each(function (id, item) {
                order.push({
                    lesson_id: $(item).data('lesson-id'),
                    position: id
                });
            });

            $.post('{{ url('/admin/courses/'.$course->slug.'/lesson_order') }}', {
                _token: '{{ csrf_token() }}',
                order: order
            })
                .done(function (r) {

                });

        }

    </script>
@endpush
