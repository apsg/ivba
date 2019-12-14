<h3>Dane do faktury:</h3>

<form action="{{ url('/user') }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}

    <div class="form-group">
        <label>Imię i nazwisko lub nazwa firmy</label>
        <input placeholder="Podaj imię lub nazwę firmy" type="text" name="company_name" required="required"
               class="form-control"
               value="{{ \Auth::user()->company_name }}">
    </div>

    <div class="form-group">
        <label>Adres</label>
        <input placeholder="Twój adres rozliczeniowy" type="text" name="address" required="required"
               class="form-control" value="{{ \Auth::user()->address }}">
    </div>

    <div class="form-group">
        <label>NIP </label>
        <input placeholder="podaj nip (opcjonalne)" type="text" name="taxid" class="form-control" value="{{ \Auth::user()->taxid }}">
    </div>

    <button class="btn btn-ivba"><i class="fa fa-save"></i> Zapisz i kontynuuj</button>

</form>
