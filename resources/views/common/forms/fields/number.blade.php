@component('common.forms.fields._base', compact('field', 'key'))
    <input
            type="number"
            step="0.01"
            class="form-control"
            required
            name="{{ $key }}"
            value="{{ old($key) }}"
            placeholder="0.0"
    />
@endcomponent
