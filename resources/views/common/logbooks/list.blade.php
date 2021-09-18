<hr/>
<h3>Twoje wcześniejsze wpisy w dzienniku</h3>

<table class="table table-striped">
    <tbody>
    @foreach($entries as $entry)
        <tr>
            <td class="fit">
                <strong>{{ $entry->created_at->format('Y-m-d') }}</strong><br/>
                <i class="fa fa-clock-o"></i> <strong>{{ $entry->created_at->format('H:i') }}</strong>
            </td>
            <td>
                <h5>{{ $entry->title }}</h5>
                <p>{{ $entry->description }}</p>

                @if($entry->comments->count() > 0)
                    <div class="mt-1 pl-2">
                        <strong>Komentarze do tego wpisu w dzienniku:</strong>
                        @foreach($entry->comments as $comment)
                            <div class="rounded my-1 bg-light-blue p-2">
                                <span style="white-space: pre-line">{{ $comment->comment }}</span>
                                <div class="border-top border-light">
                                    <i class="ml-1 fa fa-sm fa-user"></i> {{ $comment->user->full_name }}
                                    <i class="ml-3 fa fa-sm fa-clock-o"></i> {{ $comment->created_at->format('Y-m-d H:i')  }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
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
