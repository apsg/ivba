<div class="row">
    {{ csrf_field() }}
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Treść polska</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                    <label for="titlePL">Tytuł</label>
                    <input name="title" type="text" class="form-control" id="titlePL" placeholder="wpisz..."
                           required="required" value="{{ old('title') ?? $lesson->title ?? "" }}">
                </div>
                <div class="form-group">
                    <label>Wstęp </label>
                    <p>Wstęp widoczny dla wszystkich</p>
                    <textarea name="introduction" class="tinymce" rows="3"
                              placeholder="wpisz ...">{!! old('introduction') ?? $lesson->introduction ?? "" !!}</textarea>
                </div>
                <div class="form-group">
                    <label>Treść </label>
                    <textarea name="description" class="tinymce" rows="3"
                              placeholder="wpisz ...">{!! old('description') ?? $lesson->description ?? "" !!}</textarea>
                </div>
                <div class="form-group">
                    <label for="seo-titlePL">Tytuł SEO </label>
                    <input name="seo_title" type="text" class="form-control" id="seo-titlePL" placeholder="wpisz..."
                           value="{{ old('seo_title') ?? $lesson->seo_title ?? "" }}">
                </div>
                <div class="form-group">
                    <label>Opis SEO </label>
                    <textarea name="seo_description" class="form-control" rows="3"
                              placeholder="wpisz ...">{{ old('seo_description') ?? $lesson->seo_description ?? "" }}</textarea>
                </div>
            </div>

            <div class="box-footer">
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Inne ustawienia</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="duration">Czas trwania</label>
                            <div class="input-group">
                                <input id="duration" name="duration" type="number" min="0" max="999999"
                                       class="form-control" value="{{ old('duration') ?? $lesson->duration ?? 0 }}">
                                <span class="input-group-addon">min.</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="price">Cena</label>
                            <div class="input-group">
                                <span class="input-group-addon">PLN</span>
                                <input id="price" name="price" type="number" min="0" step="0.01" max="999999"
                                       class="form-control" value="{{ old('price') ?? $lesson->price ?? 0 }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="difficulty">Stopień trudności</label>
                            <select class="form-control" name="difficulty" id="difficulty" required="required">
                                <option value="1"
                                        @if( old('difficulty') == 1 || !isset($lesson) || $lesson->difficulty == 1 ) selected="selected" @endif>
                                    Łatwy
                                </option>
                                <option value="2"
                                        @if( old('difficulty') == 2 || (isset($lesson) && $lesson->difficulty == 2) ) selected="selected" @endif>
                                    Średni
                                </option>
                                <option value="3"
                                        @if( old('difficulty') == 3 || (isset($lesson) && $lesson->difficulty == 3 ) ) selected="selected" @endif>
                                    Trudny
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Slug</label>
                            <input name="slug" type="text" class="form-control" placeholder="Wpisz ..."
                                   value="{{ old('slug') ?? $lesson->slug ?? "" }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Wybierz obraz</label>
                        <input type="hidden" name="image_id" id="image_id"
                               value="{{ old('image_id') ?? $lesson->image_id ?? "" }}">
                        <button type="button" class="addmedia btn btn-default form-control" data-for-id="#image_id"
                                data-for-src="#image_img">Wybierz obraz
                        </button>
                        <div class="image-selector">
                            <img src="{{ isset($lesson) && $lesson->image()->exists() ? $lesson->image->url : "" }}"
                                 id="image_img">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Wybierz video</label>
                        <input type="hidden" name="video_id" id="video_id"
                               value="{{ old('video_id') ?? $lesson->video_id ?? "" }}">
                        <button type="button" class="addvideo btn btn-default form-control" data-for-id="#video_id"
                                data-for-src="#video_img">Wybierz film główny
                        </button>
                        <div class="image-selector">
                            <img src="{{ isset($lesson) && $lesson->video !== null ? $lesson->video->thumb(300,200) : "" }}"
                                 id="video_img">
                        </div>
                    </div>
                    @if(isset($lesson) && $lesson->video !== null)
                        <div class="col-md-12">
                            <hr/>
                            <h3>Film podpięty do lekcji:</h3>
                            <a href="{{ $lesson->video->url }}" target="_blank">{{ $lesson->video->url }}</a>
                            <br/>
                            <label>
                                Cloudflare UID:
                            </label>
                            <input type="text"
                                   name="cloudflare_uid"
                                   class="form-control"
                                   value="{{ $lesson->video->cloudflare_uid }}"
                            />
                        </div>
                    @endif
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Zapisz</button>
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
            '//www.tinymce.com/css/codepen.min.css'
          ]
        });
      });
    </script>
@endpush
