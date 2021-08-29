<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Tytuł</label>
            <input class="form-control"
                   type="text"
                   name="title"
                   value="{{ old('name') ?? $logbook->title ?? '' }}"
                   required
            />
        </div>
        <div class="form-group">
            <label>Opis</label>
            <input class="form-control"
                   type="text"
                   name="description"
                   value="{{ old('name') ?? $logbook->description ?? '' }}"
            />
        </div>
    </div>
</div>
