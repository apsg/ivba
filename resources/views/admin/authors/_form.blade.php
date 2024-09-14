<div class="row">
    {{ csrf_field() }}
    <div class="col-md-4">
        <label>Imię i nazwisko:
            <input type="text"
                   name="name"
                   value="{{ old('name') ?? $author->name ?? "" }}"
                   required
                   class="form-control"
            >
        </label>
    </div>
    <div class="col-md-4">
        <label>
            URL zdjęcia:
            <input type="text"
                   name="image"
                   value="{{ old('image') ?? $author->image ?? "" }}"
                   class="form-control"
            >
        </label>
    </div>
    <div class="col-md-4">
        <label>Trener iNauka?:
            <input type="checkbox"
                   name="is_internal"
                   value="1"
                   @if(old('is_internal') || (isset($author) && $author !== null && $author->is_internal))
                       checked
                    @endif
            >
        </label>
        <button type="submit" class="btn btn-primary ml-5">
            <i class="fa fa-save"></i>
            Zapisz
        </button>
    </div>
    <div class="col-md-12">
        <label>
            Opis krótki
        </label>
        <textarea class="form-control"
                  name="description">{{ old('description') ?? $author->description ?? '' }}</textarea>
    </div>
    <div class="col-md-12">
        <label>
            Opis długi (bio)
        </label>
        <textarea class="form-control"
                  name="bio">{{ old('bio') ?? $author->bio ?? '' }}</textarea>
    </div>
</div>
