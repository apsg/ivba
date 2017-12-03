<table>
	<tr>
		<td style="text-align: center;">
			<img src="{{ url('/images/logo.png') }}">
		</td>
	</tr>
	<tr>
		<td>
			{!! $email->body !!}
		</td>
	</tr>
</table>

<hr />
<p>Jeśli nie chcesz więcej otrzymywać maili tego typu, <a href="{{ url('/unsubscribe/'.$email->unsubscribe_code) }}">wypisz się z tych powiadomień</a></p>
<img src="{{ url('email/'.$email->id.'/img') }}">