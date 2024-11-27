@component('mail::message')

Kontakt ze strony {{ config('app.name') }}

@if($course !== null)
    Kurs: {{ $course->title }}
@endif
@if($lesson !== null)
    Lekcja: {{ $lesson->title }}
@endif


Kontakt od użytkownika {{ $user->name }} (#{{ $user->id }} - {{ $user->email }})

@if(!empty($phone))
    Numer telefonu: {{ $phone }}
@endif


Treść:
--
{!! nl2br($body) !!}

@endcomponent
