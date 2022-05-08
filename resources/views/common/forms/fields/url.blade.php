@component('common.forms.fields._base', compact('field', 'key'))
    <div class="input-group mb-2">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="fa fa-link"></i>
            </div>
        </div>
        <input type="text" class="form-control" name="{{ $key }}" required value="{{ old($key) }}" placeholder="URL">
    </div>
@endcomponent
