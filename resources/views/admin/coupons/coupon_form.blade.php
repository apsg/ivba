<div class="row">
    {{ csrf_field() }}
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Kupon</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                    <label for="code">Kod</label>
                    <input name="code" type="text" class="form-control" id="code" placeholder="wpisz..."
                           required="required" value="{{ $coupon->code ?? "" }}">
                </div>

                <div class="form-group">
                    <label for="type">Typ: </label>
                    <select name="type" id="type" class="form-control">
                        <option value="1" @if(isset($coupon) && $coupon->type==1) selected="selected" @endif >Złotowy
                        </option>
                        <option value="2" @if(isset($coupon) && $coupon->type==2) selected="selected" @endif >
                            Procentowy
                        </option>
                        <option value="3" @if(isset($coupon) && $coupon->type==3) selected="selected" @endif >Złotowy -
                            subskrypcje
                        </option>
                        <option value="4" @if(isset($coupon) && $coupon->type==4) selected="selected" @endif >Procentowy
                            - sybskrypcje
                        </option>
                        <option value="5" @if(isset($coupon) && $coupon->type==5) selected="selected" @endif >Dostęp do kursu
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="amount">Wartość</label>
                    <input name="amount" type="number" min="0" step="0.01" class="form-control" id="amount"
                           placeholder="wpisz..." required="required" value="{{ $coupon->amount ?? "" }}">
                </div>

                <div class="form-group">
                    <label for="uses_left">Liczba użyć</label>
                    <input name="uses_left" type="number" min="0" step="1" class="form-control" id="uses_left"
                           placeholder="wpisz..." required="required" value="{{ $coupon->uses_left ?? 1 }}">
                </div>

            </div>

            <div class="box-footer">

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Zapisz</button>
                </div>
            </div>
        </div>
    </div>
</div>
