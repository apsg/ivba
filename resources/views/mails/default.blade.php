@component('mail::message')
# {{ $email->title }}

{!! $email->body !!}

@component('mail::button', ['url' => url('/account')])
    Zobacz swoje konto w serwisie {{ config('app.name') }}
@endcomponent

Dziękujemy!<br>
{{ config('app.name') }}

---
Jeśli nie chcesz więcej otrzymywać maili tego typu, [wypisz się z tych powiadomień]({{ url('/unsubscribe/'.$email->unsubscribe_code) }})

![img]({{ url('email/'.$email->id.'/img') }})
@endcomponent