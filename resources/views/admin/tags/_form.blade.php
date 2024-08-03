<div class="row">
    {{ csrf_field() }}
    <div class="col-md-4">
        <label>Nazwa:
            <input type="text"
                   name="name"
                   value="{{ old('name') ?? $tag->name ?? "" }}"
                   required
                   class="form-control"
            >
        </label>
    </div>
    <div class="col-md-4">
        <label>
            Kolor:
            <input type="text"
                   name="color"
                   value="{{ old('color') ?? $tag->color ?? "" }}"
                   class="form-control"
            >
        </label>
    </div>
    <div class="col-md-4">
        <label>Ukryta:
            <input type="checkbox"
                   name="is_hidden"
                   value="1"
            @if(old('is_hidden') || (isset($tag) && $tag !== null && $tag->is_hidden))
                checked
            @endif
            >
        </label>
        <button type="submit" class="btn btn-primary ml-5">
            <i class="fa fa-save"></i>
            Zapisz
        </button>
    </div>
</div>
