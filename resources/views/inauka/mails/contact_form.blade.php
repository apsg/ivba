@component('mail::message')

Formularz kontaktowy ze strony {{ config('app.name') }}

@component('mail::table')
| Imię          | Email         |
| ------------- |:-------------:|
| {{ $name }}   | {{ $email }}  |
@endcomponent

Treść:
--
{{ $body }}

@endcomponent