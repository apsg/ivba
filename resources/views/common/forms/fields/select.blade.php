@component('common.forms.fields._base', compact('field', 'key'))
    <select name="{{ $key }}" class="form-control">
        @foreach($field['values'] as $value)
            <option value="{{ $value }}" @if($value == old($key)) selected @endif>{{ $value }}</option>
        @endforeach
    </select>
@endcomponent
