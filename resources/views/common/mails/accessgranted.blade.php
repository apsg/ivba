@component('mail::message')
# Przyznano dostęp

Przyznano Ci dostęp do kursu.

@component('mail::button', ['url' => $url])
    Zobacz swoje kursy
@endcomponent

Dziękujemy,<br>
{{ config('app.name') }}
@endcomponent
