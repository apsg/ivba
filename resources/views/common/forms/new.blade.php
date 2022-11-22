<div>
    <h3 class="font-primary">Dodaj nowy wpis</h3>
    <form action="{{ route('learn.course.form.store', compact('form', 'course')) }}" method="post">
        @csrf

        @foreach($form->fields as $key => $field)
            @component('common.forms.fields.'.$field['type'], ['field' => $field, 'key' => $key])@endcomponent
        @endforeach

        <button class="btn btn-primary">Prześlij</button>
    </form>

</div>
