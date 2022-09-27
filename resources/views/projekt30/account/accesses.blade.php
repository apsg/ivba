<h3>Twoje dostępy i subskrypcje</h3>
<table class="table">
    <thead>
    <tr>
        <th>Dostęp do</th>
        <th>Data rozpoczęcia</th>
        <th>Wygasa/następna płatność</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @if( !is_null(\Auth::user()->full_access_expires) )
        <tr>
            <th scope="row">Pełen dostęp do platformy iNauka</th>
            <td>-</td>
            <td>{{ $user->full_access_expires }}</td>
            <td>
                @if($user->full_access_expires->isPast())
                    <i class="fa fa-minus-circle text-danger"></i> Wygasł
                @else
                    <i class=" fa fa-check text-success"></i> Aktywny
                @endif
            </td>
        </tr>
    @endif
    @foreach( $user->subscriptions as $subscription )
        <tr>
            <th scope="row">
                Subskrypcja - abonament miesięczny
            </th>
            <td>{{ $subscription->created_at->format('Y-m-d') }}</td>
            <td>
                {{ $subscription->valid_until }}
            </td>
            <td>
                @if($subscription->isPending())
                    <i class="fa fa-refresh text-info mr-3"></i> Oczekujemy na potwierdzenie z Twojego banku
                @else
                    @if($subscription->cancelled_at)
                        <i class="fa fa-minus-circle text-danger"></i> Zakończono - anulowana
                    @else
                        <i class="fa fa-check text-success"></i> Aktywna
                        <a href="{{ url('/subscription/'.$subscription->id.'/cancel') }}"
                           class="btn btn-danger btn-sm confirm"><i class="fa fa-times"></i> Anuluj</a>
                    @endif
                @endif

            </td>
        </tr>
    @endforeach
    @if($user->remaining_days > 0)
        <tr>
            <th colspan="3" scope="row" class="text-right"><strong>Pozostało aktywnych dni na tym
                    koncie:</strong></th>
            <td>
                <strong class="text-success">{{ $user->remaining_days }}</strong>
            </td>
        </tr>
    @endif

    @foreach($user->accesses as $access)
        <tr>
            <th scope="row">
                <a href="{{ $access->accessable->link() }}" target="_blank">{{ $access->accessable }}</a>
            </th>
            <td>{{ $access->created_at->format('Y-m-d') }}</td>
            <td>
                @if($access->expires_at == null)
                    bezterminowo
                @else
                    {{ $access->expires_at->format('Y-m-d') }}
                @endif
            </td>
            <td><i class="fa fa-check"></i> Aktywny</td>
        </tr>
    @endforeach

    </tbody>
</table>
