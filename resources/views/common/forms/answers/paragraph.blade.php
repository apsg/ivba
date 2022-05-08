@foreach($answer->answers as $key => $value)
    {{ $answer->form->textForKey($key) }}: <strong>{{ $value }}</strong> <br />
@endforeach
