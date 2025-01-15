<div class="row">
    {{ csrf_field() }}
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Treść</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                    <label for="titlePL">Tytuł</label>
                    <input name="title" type="text" class="form-control" id="titlePL" placeholder="wpisz..."
                           required="required" value="{{ $course->title ?? "" }}">
                </div>
                <div class="form-group">
                    <label>Opis</label>
                    <textarea name="description" class="tinymce" rows="3"
                              placeholder="wpisz ...">{!! $course->description ?? "" !!}</textarea>
                </div>

                <div class="form-group">
                    <label>Na kursie dowiesz się... (jeden element per linia)</label>
                    <textarea name="things" class="w-100 form-control" rows="3"
                              placeholder="wpisz ...">{!! $course->things ?? "" !!}</textarea>
                </div>

                <div class="form-group">
                    <label>Tematy (tagi) (jeden element per linia)</label>
                    <textarea name="topics" class="w-100 form-control" rows="3"
                              placeholder="wpisz ...">{!! $course->topics ?? "" !!}</textarea>
                </div>

                <div class="form-group">
                    <label for="seo-titlePL">Tytuł SEO </label>
                    <input name="seo_title" type="text" class="form-control" id="seo-titlePL" placeholder="wpisz..."
                           value="{{ $course->seo_title ?? "" }}">
                </div>
                <div class="form-group">
                    <label>Opis SEO </label>
                    <textarea name="seo_description" class="form-control" rows="3"
                              placeholder="wpisz ...">{{ $course->seo_description ?? "" }}</textarea>
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
                    @if(isset($authors))
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="price">Autor</label>
                                <div class="input-group">
                                    <select name="author_id" class="form-control">
                                        <option value="">-- brak --</option>
                                        @foreach($authors as $author)
                                            <option value="{{ $author->id }}"
                                                    @if($course !== null && $course->author_id == $author->id)
                                                        selected
                                                    @endif
                                            >
                                                {{ $author->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="price">Cena</label>
                            <div class="input-group">
                                <span class="input-group-addon">PLN </span>
                                <input id="price" name="price" type="number" min="0" step="0.01" max="999999"
                                       class="form-control" value="{{ $course->price ?? 0 }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="price_full">Cena przed obniżką</label>
                            <div class="input-group">
                                <span class="input-group-addon">PLN </span>
                                <input id="price_full" name="price_full" type="number" min="0" step="0.01" max="999999"
                                       class="form-control" value="{{ $course->price_full ?? 0 }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Link płatności</label>
                            <input name="payment_link" type="text" class="form-control" placeholder="Wpisz ..."
                                   value="{{ $course->payment_link ?? "" }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="difficulty">Stopień trudności</label>
                            <select class="form-control" name="difficulty" id="difficulty" required="required">
                                <option value="1"
                                        @if( !isset($course) || $course->difficulty == 1 ) selected="selected" @endif>
                                    Łatwy
                                </option>
                                <option value="2"
                                        @if( isset($course) && $course->difficulty == 2 ) selected="selected" @endif>
                                    Średni
                                </option>
                                <option value="3"
                                        @if( isset($course) && $course->difficulty == 3 ) selected="selected" @endif>
                                    Trudny
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Slug</label>
                            <input name="slug" type="text" class="form-control" placeholder="Wpisz ..."
                                   value="{{ $course->slug ?? "" }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Wybierz obraz</label>
                        <input type="hidden" name="image_id" id="image_id" value="{{ $course->image_id ?? "" }}">
                        <button class="addmedia btn btn-default form-control" data-for-id="#image_id"
                                data-for-src="#image_img">Wybierz obraz
                        </button>
                        <div class="image-selector">
                            <img src="{{ isset($course) && $course->image()->exists() ? $course->image->url : "" }}"
                                 id="image_img">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Wybierz Film</label>
                        <input type="hidden" name="video_id" id="video_id" value="{{ $course->video_id ?? "" }}">
                        <button class="addvideo btn btn-default form-control" data-for-id="#video_id"
                                data-for-src="#video_img">Wybierz film okładkowy
                        </button>
                        <div class="image-selector">
                            <img src="{{ isset($course) && $course->video()->exists() ? $course->video->thumb(300, 200) : "" }}"
                                 id="video_img">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>
                            <input type="checkbox"
                                   name="is_special_access"
                                   class="checkbox"
                                   value="1"
                                   @if(!empty($course->is_special_access))
                                       checked
                                    @endif
                            >
                            Dostęp specjalny
                        </label>
                        <p>Dostęp specjalny oznacza, że nawet użytkownicy z pełnym dostępem nie mają dostępu do kursu.
                            Dostęp do takiego kursu musi zostać przyznany każdorazowo per kurs per użytkownik.
                        </p>
                    </div>
                    <div class="col-md-12">
                        <label>
                            Data startu kursu specjalnego
                        </label>
                        <input type="datetime-local"
                               name="scheduled_at"
                               value="{{ (isset($course) && $course->scheduled_at !== null) ? $course->scheduled_at->format('Y-m-d\TH:i') : '' }}"
                        >
                        <p>
                            Jeśli ustawisz datę startu kursu specjalnego oraz opóźnienia poszczególnych lekcji, to
                            będą się one wyświetlać zgodnie z zaplanowanym opóźnieniem (w godzinach) w stosunku do
                            zaplanowanej daty startu.
                        </p>
                    </div>
                    <div class="col-md-12">
                        <label>
                            <input type="checkbox"
                                   name="is_systematic"
                                   class="checkbox"
                                   value="1"
                                   @if(!empty($course->is_systematic))
                                       checked
                                    @endif
                            >
                            Kurs systematyczny
                        </label>
                        <p>Lekcje w kursie systtematycznym pokazywane są z opóźnieniem liczonym relatywnie od momentu
                            rozpoczęcia kursu przez użytkownika.
                        </p>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Licznik</h3>
            </div>
            <div class="box-body row">
                <label>
                    Odliczanie do:
                    <input type="datetime-local"
                           name="promo_counter"
                           value="{{ (isset($course) && $course->promo_counter !== null) ? old('promo_counter',$course->promo_counter) : '' }}"
                    >
                </label>
                <label>Tekst nad licznikiem:</label>
                <input type="text"
                       class="form-control"
                       name="promo_text"
                       value="{{ old('promo_text', isset($course) ? $course->promo_text : '') }}"
                >
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Sekcja wynagrodzenie</h3>
            </div>
            <div class="box-body row">
                <label>Zakres wynagrodzenia:
                    <input type="text"
                           class="form-control"
                           name="salary_range"
                           placeholder="np. 100-200 zł lub 4000 PLN - 5000 PLN"
                           @if(isset($course)) value="{{ old('salary_range', $course->salary_range) }}" @endif>
                </label>
                <label>Umiejętności (lub inny tekst pod zakresem):
                    <input type="text"
                           class="form-control"
                           name="salary_skills"
                           placeholder="np. Umiejętności: Power BI"
                           @if(isset($course)) value="{{ old('salary_skills', $course->salary_skills) }}" @endif>
                </label>
                <label>Link do CTA:
                    <input type="text"
                           class="form-control"
                           name="salary_cta"
                           @if(isset($course)) value="{{ old('salary_cta', $course->salary_cta) }}" @endif>
                </label>
            </div>

        </div>
    </div>

    <div>
        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Zapisz</button>
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
