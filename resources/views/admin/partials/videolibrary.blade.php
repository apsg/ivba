@push('modals')
    <div class="modal medialibrary" id="videolibrary" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Biblioteka Filmów</h4>
                </div>
                <div class="modal-body">
                    <div>

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item active">
                                <a class="nav-link" href="#select-videos" aria-controls="select-videos" role="tab"
                                   data-toggle="tab" id="tab-list-button">Wybierz</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#add-new-video" aria-controls="add-new-video" role="tab"
                                   data-toggle="tab">Dodaj
                                    nowy</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#import-video" aria-controls="import-video" role="tab"
                                   data-toggle="tab">Importuj</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="select-videos">
                            </div>
                            <div role="tabpanel" class="tab-pane" id="add-new-video">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Dodaj nowy plik do biblioteki mediów: </h4>
                                        <form id="add-new-video-form" action="{{ url('admin/videos') }}" method="post"
                                              enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="file" name="video" required="required">
                                            <input type="hidden" name="title" id="title-additional">
                                            <button>Wyślij</button>
                                        </form>
                                        <div class="progress">
                                            <div id="progressbar"
                                                 class="progress-bar progress-bar-primary progress-bar-striped active"
                                                 role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                                 aria-valuemax="100" style="width: 0%">
                                                <span class="sr-only"> </span>
                                            </div>
                                        </div>
                                        <span id="progress-msg"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="new-file-video" data-id="0" data-src="" class="hidden image video">
                                            <img src="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="import-video">
                                <div class="row">
                                    <div class="col-md-12 pt-3">
                                        <h5>Importuj istniejący plik</h5>

                                        <form id="import-video-form" action="{{ url('admin/videos/import') }}"
                                              method="post">
                                            @csrf


                                            <div class="form-group">
                                                <label for="import-name">Nazwa pliku</label>
                                                <input name="name" type="text" class="form-control" id="import-name"
                                                       placeholder="Podaj nazwę..." required>
                                            </div>
                                            <div class="form-group">
                                                <label for="import-url">Cloudflare ID:</label>
                                                <input name="cloudflare_id" type="text" class="form-control" id="import-url"
                                                       placeholder="Cloudflare ID" required>
                                            </div>

                                            <button class="btn btn-primary">Importuj</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left close-modal" data-dismiss="modal">Zamknij
                    </button>
                    <button type="button" class="btn btn-primary " id="insert-selected-video">Wstaw wybrany</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endpush

@push('scripts')
    <script type="text/javascript">

        $(document).ready(function () {
            $('.addvideo').on('click, focus', function (e) {
                e.preventDefault();
                $("#videolibrary").fadeIn(100);

                window.media_id = $(this).data('for-id');
                window.media_src = $(this).data('for-src');
                window.media_src_input = $(this).data('for-src-input');

                loadVideos();
            });

            $("#videolibrary .close-modal").click(function () {
                $("#videolibrary").fadeOut(100);
            });

            $("#insert-selected-video").click(function () {
                if ($(".ui-selected").length == 0) {
                    alert('Musisz wpierw wybrać jakiś obraz');
                } else {
                    let id = $(".video.ui-selected").data('id');
                    let src = $(".video.ui-selected").data('src');

                    $(window.media_id).val(id);
                    $(window.media_src_input).val(src);
                    $(window.media_src).attr('src', thumbUrl(src));

                    $('#videolibrary').fadeOut(100);
                }
            });

            $("#videolibrary").on('click', '.pagination a', function (e) {
                e.preventDefault();

                $.get($(this).attr('href'), {_token: '{{ csrf_token() }}'}).done(function (r) {
                    $("#select-videos").html(r);
                    $("#select-videos .imageslist").selectable();
                });

            });

            $("#import-video-form").submit(function (e) {
                e.preventDefault();

                $.post($("#import-video-form").attr('action'), {
                    _token: '{{ csrf_token() }}',
                    name: $("#import-name").val(),
                    cloudflare_id: $("#import-url").val(),
                }).done(function (data) {
                    loadVideos();
                    $("#tab-list-button").tab('show');
                }).catch(function (e) {
                    console.log(e);
                });
            });

            $("#add-new-video-form").submit(function (e) {
                e.preventDefault();

                $('#title-additional').val($("#titlePL").val());

                var button = $(this).find('button');
                button.prop('disabled', true);
                $('body, window').css({cursor: 'wait'});

                var formData = new FormData($(this)[0]);
                formData._token = '{{ csrf_token() }}';

                $.ajax({
                    xhr: function () {
                        var xhr = new window.XMLHttpRequest();

                        xhr.upload.addEventListener("progress", function (evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = evt.loaded / evt.total;
                                percentComplete = parseInt(percentComplete * 100);
                                console.log(percentComplete);

                                $("#progressbar").css({width: percentComplete + "%"});

                                if (percentComplete === 100) {
                                    $("#progress-msg").text("Przetwarzam, proszę czekać...");
                                    $("#progressbar").removeClass('active');
                                }

                            }
                        }, false);

                        return xhr;
                    },
                    url: $(this).attr("action"),
                    data: formData,
                    headers: {
                        'X-CSRF-Token': $(this).find('[name="_token"]').val()
                    },
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    type: 'POST'
                }).done(function (data) {
                    console.log(data);
                    $("#new-file-video").data('id', data.id)
                        .data('src', thumbUrl(data.thumb))
                        .find('img')
                        .attr('src', thumbUrl(data.thumb));

                    $(".ui-selected").removeClass('ui-selected');
                    $("#new-file-video").addClass('ui-selected').removeClass('hidden');
                    $('body, window').css({cursor: ''});
                    button.prop('disabled', false);

                });
            });

        });

        function thumbUrl(thumb) {
            return thumb;
        }

        function loadVideos() {
            $.get('{{ url('/admin/videos') }}', {_token: '{{ csrf_token() }}'}).done(function (r) {
                $("#select-videos").html(r);
                $("#select-videos .imageslist").selectable();
            });
        }

    </script>

@endpush
