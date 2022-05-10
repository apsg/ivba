@component('common.forms.fields._base', compact('field', 'key'))
    <div class="input-group mb-2">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="fa fa-calendar-o"></i>
            </div>
        </div>
        <week-selector name="{{$key}}"></week-selector>
    </div>
@endcomponent
