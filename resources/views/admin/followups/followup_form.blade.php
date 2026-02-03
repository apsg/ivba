<div class="row">
    {{ csrf_field() }}
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Treść</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                    <label for="titlePL">Tytuł</label>
                    <input name="title" type="text" class="form-control" id="titlePL" placeholder="wpisz..."
                           required="required" value="{{ old('title') ?? $followup->title ?? "" }}">
                </div>
                <div class="form-group">
                    <label>Slug</label>
                    <input name="slug" type="text" class="form-control" placeholder="Wpisz ..."
                           value="{{ old('slug') ?? $followup->slug ?? "" }}">
                </div>

                @if( !empty($followup->delay) )
                    <div class="form-group">
                        <label>Opóźnienie</label>
                        <p>Poniższy string musi być prawidłowym stringiem <a
                                    href="http://php.net/manual/en/dateinterval.construct.php">interwału czasowego</a>
                        </p>
                        <input name="delay" type="text" class="form-control"
                               value="{{ old('delay') ?? $followup->delay ?? "" }}">
                    </div>
                @else
                    <div class="form-group row">

                        <div class="col-md-3">
                            <label>Opóźnienie</label>
                        </div>
                        <div class="col-md-3">
                            <input value="0" type="number" name="delay" min="0" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <select name="unit" class="form-control">
                                <option value="1">Minut</option>
                                <option value="2">Godzin</option>
                                <option value="3">Dni</option>
                                <option value="4">Tygodni</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <p>Po zdarzeniu:</p>
                            <select name="event" class="form-control">
                                @foreach(\App\Helpers\FollowupsHelper::FOLLOWUPS as $name => $description)
                                    <option
                                            value="{{$name}}"
                                            @if($selected == $name) selected @endif
                                    >{{ $description }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <label>Treść</label>
                    <textarea name="body" class="tinymce" rows="3"
                              placeholder="wpisz ...">{!! old('body') ?? $followup->body ?? "" !!}</textarea>
                </div>

                @if( isset($followup) && $followup->attachment )
                    <p>Aktualnie dodany załącznik: </p>
                    <p><strong>{{ $followup->attachment }}</strong></p>
                    <p>Możesz go podmienić dodając nowy poniżej:</p>
                @endif
                <div class="form-group">
                    <label>Załącznik</label>
                    <input type="file" name="attachment">
                </div>

            </div>

            <div class="box-footer">

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Zapisz</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            tinymce.init({
                selector: '.tinymce',
                height: 500,
                relative_urls: false,
                remove_script_host: false,
                file_browser_callback: function (field_name, url, type, win) {
                    console.log(field_name);
                    window.media_src_input = "#" + field_name;
                    $("#medialibrary").fadeIn(100);
                    loadImages();
                },
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table paste imagetools"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                // imagetools_cors_hosts: ['www.tinymce.com', 'codepen.io'],
                content_css: [
                    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                ]
            });
        });
    </script>
@endpush
