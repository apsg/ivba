@component('mail::message')
# {{ $email->title }}

{!! $email->body !!}

@component('mail::button', ['url' => url('/account')])
    Zobacz swoje konto w serwisie {{ config('app.name') }}
@endcomponent

Dziękujemy!<br>
{{ config('app.name') }}

---
@if(!empty($email->unsubscribe_code))
Jeśli nie chcesz więcej otrzymywać maili tego typu, [wypisz się z tych powiadomień]({{ url('/unsubscribe/'.$email->unsubscribe_code) }})
@endif

![img]({{ url('email/'.$email->id.'/img') }})
@endcomponent