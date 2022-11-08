<h4>Twoje dodatki</h4>
<table class="table">
    <thead>
    <tr>
        <th>Nazwa</th>
        <th>Data zakupu</th>
        <th>Link</th>
    </tr>
    </thead>
    <tbody>
    @foreach( $user->quick_sale_orders as $order )
        <tr>
            <th scope="row">{{ $order->quick_sales[0]->name }}</th>
            <td>{{ $order->confirmed_at }}</td>
            <td>
                @if($order->quick_sales[0]->file_url !== null)
                    <p>
                        <a target="_blank" href="{{ $order->quick_sales[0]->file_url }}">Pobierz plik</a>
                    </p>
                @endif
                @if($order->quick_sales[0]->course_id !== null)
                    <p>
                        <a target="_blank" href="{{ url('/learn/course/'.$order->quick_sales[0]->course->slug) }}">
                            Przejdź do kursu
                        </a>
                    </p>
                @endif

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
