<table class="table table-striped">
    <tbody>
    @foreach($answer->answers as $key => $value)
        <tr>
            <td>{{ $answer->form->textForKey($key) }}</td>
            <td>{{ $value }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
