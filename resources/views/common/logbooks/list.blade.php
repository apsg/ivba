<hr/>
<h3>Twoje wcześniejsze wpisy w dzienniku</h3>

<table class="table table-striped">
    <tbody>
    @foreach($entries as $entry)
        <tr>
            <td class="fit">
                <strong>{{ $entry->created_at->format('Y-m-d') }}</strong><br />
                <i class="fa fa-clock-o"></i> <strong>{{ $entry->created_at->format('H:i') }}</strong>
            </td>
            <td>
                <h5>{{ $entry->title }}</h5>
                <p>{{ $entry->description }}</p>
            </td>
            <td class="fit">
                @if($entry->hasImage())
                    <image-preview url="{{ $entry->imageUrl() }}"></image-preview>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
