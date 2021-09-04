<div class="">
    <hr/>
    <h3>Dodaj nowy wpis w dzienniku</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('learn.logbook.store', compact('course', 'logbook')) }}"
          method="post"
          enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Tytuł: </label>
            <input name="title" class="form-control" value="{{ old('title') }}">
        </div>

        <div class="form-group">
            <label>Opis: </label>
            <textarea name="description" class="form-control">{{ old('description') }}
            </textarea>
        </div>

        <div class="form-group">
            <label>Załaduj zdjęcie (opcjonalnie):</label>
            <input type="file" name="image" class="form-control" value="{{ old('image') }}">
        </div>

        <button class="btn btn-ivba mt-3">
            <i class="fa fa-save"></i> Dodaj wpis
        </button>
    </form>
</div>
