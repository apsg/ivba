<form action="{{ url('/user') }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}

    <div class="form-group">
        <label>Imię</label>
        <input placeholder="Wpisz swoje imię..." type="text" name="first_name" required="required" class="form-control"
               value="{{ \Auth::user()->first_name }}">
    </div>

    <div class="form-group">
        <label>Nazwisko</label>
        <input placeholder="Wpisz swoje nazwisko..." type="text" name="last_name" required="required"
               class="form-control" value="{{ \Auth::user()->last_name }}">
    </div>

    <div class="form-group">
        <label>Adres zamieszkania (rozliczeniowy)</label>
        <input placeholder="Wpisz swój adres zamieszkania..." type="text" name="address" required="required"
               class="form-control" value="{{ \Auth::user()->address }}">
    </div>

    <div class="form-group">
        <label>NIP (do faktury)</label>
        <input placeholder="podaj nip" type="text" name="taxid" class="form-control" value="{{ \Auth::user()->taxid }}">
    </div>

    <button class="btn btn-ivba"><i class="fa fa-save"></i> Zapisz i kontynuuj</button>

</form>
