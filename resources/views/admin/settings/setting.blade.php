<div class="col-md-6 p-1">
    <div class="card">
        <div class="card-header">
            <h5>{{ $description }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.settings.set') }}" method="post">
                @csrf
                <input type="hidden" name="key" value="{{ $key }}">
                <input type="text" name="value" class="form-control" value="{{ $settings[$key] }}"/>
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
