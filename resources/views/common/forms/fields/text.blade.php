@component('common.forms.fields._base', compact('field', 'key'))
    <input type="text" class="form-control" name="{{ $key }}" required value="{{ old($key) }}">
@endcomponent
