<h3>Dane do faktury:</h3>

<form action="{{ url('/user') }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}

    <div class="form-group">
        <label>Imię i nazwisko lub nazwa firmy</label>
        <input placeholder="Podaj imię lub nazwę firmy" type="text" name="company_name" required="required"
               class="form-control"
               value="{{ old('company_name', \Auth::user()->company_name) }}">
    </div>

    <div class="form-group">
        <label>Adres</label>
        <input placeholder="Twój adres rozliczeniowy" type="text" name="address" required="required"
               class="form-control" value="{{ old('address', \Auth::user()->address) }}">
    </div>

    <div class="form-group">
        <label>NIP </label>
        <input placeholder="podaj nip (opcjonalne)" type="text" name="taxid" class="form-control" value="{{ old('taxid', \Auth::user()->taxid) }}">
    </div>

    <div class="form-group">
        <label>PESEL (w przypadku kursów MEN)</label>
        <input placeholder="podaj pesel (opcjonalne)" type="text" name="pesel" class="form-control" value="{{ old('pesel', \Auth::user()->pesel) }}">
    </div>

    <button class="btn btn-ivba"><i class="fa fa-save"></i> Zapisz i kontynuuj</button>

</form>
