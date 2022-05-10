@foreach($answer->answers as $key => $value)
    @if($linksClickable === true && $answer->form->isUrl($key))
        {{ $answer->form->textForKey($key) }}: <a href="{{ $value }}" target="_blank">{{ $value }}</a> <br>
    @else
        {{ $answer->form->textForKey($key) }}: <strong>{{ $value }}</strong> <br/>
    @endif
@endforeach
