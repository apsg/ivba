<div class="col-md-6 p-1">
    <div class="card">
        <div class="card-header">
            <h5>{{ $description }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.settings.set') }}" method="post">
                @csrf
                <input type="hidden" name="key" value="{{ $key }}">
                @if(\App\Domains\Admin\Helpers\SettingsHelper::isBool($key))
                    <div class="form-group">
                        <label>
                            <input type="checkbox"
                                   class="form-check-inline"
                                   name="value"
                                   value="1"
                                   @if($settings[$key]) checked @endif
                            >
                            {{ $description }}
                        </label>
                    </div>
                @elseif(\App\Domains\Admin\Helpers\SettingsHelper::isSelect($key))
                    <div class="form-group">
                        <select name="value" class="form-control">
                            <option value="">--</option>
                            @foreach(\App\Domains\Admin\Helpers\SettingsHelper::getSelectItems($key) as $value => $name)
                                <option
                                        value="{{ $value }}"
                                        @if($value == $settings[$key]) selected @endif
                                >
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @else
                    <input type="text"
                           name="value"
                           class="form-control"
                           value="{{ $settings[$key] }}"/>
                @endif
                <button class="btn btn-ivba">Zapisz</button>
            </form>
        </div>
        <div class="card-footer">
            <form action="{{ route('admin.settings.delete') }}" method="post">
                @csrf
                @method('delete')
                <input type="hidden" name="key" value="{{ $key }}">
                <button class="btn btn-danger">
                    <i class="fa fa-trash"></i> Resetuj do domyślnych
                </button>
            </form>
        </div>
    </div>
</div>
