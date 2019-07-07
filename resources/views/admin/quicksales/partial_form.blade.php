<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Nazwa</label>
            <input name="name" type="text" required class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>Opis</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <label>Link do regulaminu</label>
            <input name="rules_url" type="text" required class="form-control" value="{{ old('rules_url') }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Cena zł</label>
            <input name="price" type="number" min="0" step="0.01" required class="form-control"
                   value="{{ old('price') }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Cena zł przed obniżką (opcjonalnie)</label>
            <input name="full_price" type="number" min="0" step="0.01" class="form-control"
                   value="{{ old('fulL_price') }}">
        </div>
    </div>
    <div class="col-md-12">
        <label>Wybierz kurs przypięty do szybkiej sprzedaży</label>
        <select name="course_id" class="form-control">
            @foreach($courses as $course)
                <option value="{{ $course->id }}">#{{$course->id}} - {{ $course->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-12">
        <h3 class="mt-2">Email</h3>
        <div class="form-group">
            <label>Adres email (from)</label>
            <input name="message_email" type="email" class="form-control" value="{{ old('message_email') }}">
        </div>
        <div class="form-group">
            <label>Tytuł</label>
            <input name="message_subject" type="text" class="form-control" value="{{ old('message_subject') }}">
        </div>
        <div class="form-group">
            <label>Treść</label>
            <textarea name="message_body" class="form-control">{{ old('message_body') }}</textarea>
        </div>
    </div>
</div>
