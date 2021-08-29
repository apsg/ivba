<div class="">
    <hr />
    <h3>Dodaj nowy wpis w dzienniku</h3>
    <form action="{{ route('learn.logbook.store', compact('course', 'logbook')) }}" method="post">
        @csrf

        <div class="form-group">
            <label>Tytuł: </label>
            <input name="title" class="form-control">
        </div>

        <div class="form-group">
            <label>Opis: </label>
            <textarea name="description" class="form-control">
            </textarea>
        </div>

        <div class="form-group">
            <label>Załaduj zdjęcie (opcjonalnie):</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-ivba mt-3">
            <i class="fa fa-save"></i> Dodaj wpis
        </button>
    </form>
</div>
