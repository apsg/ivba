<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Nazwa</label>
            <input name="name" type="text" required class="form-control"
                   value="{{ old('name') ?? $quickSale->name ?? '' }}">
        </div>
        <div class="form-group">
            <label>Opis</label>
            <textarea name="description"
                      class="form-control">{{ old('description') ?? $quickSale->description ?? '' }}</textarea>
        </div>
        <div class="form-group">
            <label>Link do regulaminu</label>
            <input name="rules_url" type="text" required class="form-control"
                   value="{{ old('rules_url') ?? $quickSale->rules_url ?? '' }}">
        </div>
        <div class="form-group">
            <label>Strona przekierowania po płatności (relatywna <span class="text-monospace">/przyklad</span> lub
                absolutna <span class="text-monospace">http://test.com</span>).</label>
            <input name="redirect_url" type="text" class="form-control"
                   value="{{ old('redirect_url') ?? $quickSale->redirect_url ?? '' }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Cena zł</label>
            <input name="price" type="number" min="0" step="0.01" required class="form-control"
                   value="{{ old('price') ?? $quickSale->price ?? ''  }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Cena zł przed obniżką (opcjonalnie)</label>
            <input name="full_price" type="number" min="0" step="0.01" class="form-control"
                   value="{{ old('fulL_price') ?? $quickSale->full_price ?? ''  }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-check">
            <input name="is_full_data_required" type="checkbox" class="form-check-input" id="defaultCheck1"
                   @if(old('is_full_data_required') || !empty($quickSale->is_full_data_required) ) checked
                   @endif value="1">
            <label class="form-check-label" for="defaultCheck1">
                <strong>Wymagaj pełnych danych (adres itp)</strong>
            </label>
        </div>
    </div>
    <div class="col-md-12">
        <label>Wybierz kurs przypięty do szybkiej sprzedaży</label>
        <select name="course_id" class="form-control">
            <option value="">-- brak --</option>
            @foreach($courses as $course)
                <option
                        @if(isset($quickSale) && $course->id == $quickSale->course_id)
                        selected="selected"
                        @endif
                        value="{{ $course->id }}">
                    #{{$course->id}} - {{ $course->title }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Link załącznika:</label>
            <input name="file_url" type="url" class="form-control"
                   value="{{ old('file_url') ?? $quickSale->file_url ?? '' }}">
        </div>
    </div>
    <div class="col-md-12">
        <h3 class="mt-2">Email</h3>
        <div class="form-group">
            <label>Adres email (from)</label>
            <input name="message_email" type="email" class="form-control"
                   value="{{ old('message_email') ?? $quickSale->message_email ?? ''  }}">
        </div>
        <div class="form-group">
            <label>Tytuł</label>
            <input name="message_subject" type="text" class="form-control"
                   value="{{ old('message_subject') ?? $quickSale->message_subject ?? '' }}">
        </div>
        <div class="form-group">
            <label>Treść</label>
            <textarea name="message_body" class="tinymce">{{ old('message_body') ?? $quickSale->message_body ?? '' }}</textarea>
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
                    '//www.tinymce.com/css/codepen.min.css'
                ]
            });
        });
    </script>
@endpush
