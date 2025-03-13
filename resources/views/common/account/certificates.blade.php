<h3>Twoje certyfikaty</h3>
<table class="table">
    <thead>
    <tr>
        <th>Nazwa</th>
        <th>Data uzyskania</th>
        <th>Link</th>
    </tr>
    </thead>
    <tbody>
    @foreach( $certificates as $certificate )
        <tr>
            <th scope="row">{{ $certificate['title'] }}</th>
            <td>{{ $certificate['date'] }}</td>
            <td>
                <a href="{{ $certificate['url'] }}" target="_blank">{{ $certificate['url'] }}</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
