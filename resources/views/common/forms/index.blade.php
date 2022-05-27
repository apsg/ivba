<h3 class="mt-5">Twoje wcześniejsze wpisy</h3>
<table class="table table-striped">
    <thead>
    <tr>
        <th>Data</th>
        <th>Odpowiedzi</th>
        <th>Komentarz</th>
    </tr>
    </thead>
    <tbody>
    @foreach($answers as $answer)
        <tr>
            <td>{{ $answer->created_at }}</td>
            <td class="dont-break-out">{!! $answer->formatAnswersAsTable() !!}</td>
            <td>{{ $answer->comment ?? 'brak' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
