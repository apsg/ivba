<div class="form-group">
    <label>
        {{ $field['name'] }}
    </label>

    {{ $slot }}

    @if($errors->has($key))
        <div class="alert alert-danger">
            @foreach($errors->get($key) as $error)
                <p>Niewłaściwy format</p>
            @endforeach
        </div>
    @endif
</div>
