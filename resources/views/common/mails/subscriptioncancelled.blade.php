@php
/** @var \App\Subscription $subscription */
@endphp
@component('mail::message')
# Użytkownik anulował subskrypcję

Użytkownik anulował subskrypcję Stripe w serwisie {{ config('app.name') }}

Użytkownik: #{{ $subscription->user->id }} {{ $subscription->user->email }}

ID subskrypcji w stripe: {{ $subscription->stripe_subscription_id }}

@component('mail::button', ['url' => url('/admin/user/' . $subscription->user->id)])
    Zobacz użytkownika
@endcomponent

@component('mail::button', ['url' => 'https://dashboard.stripe.com/'])
    Przejdź do Stripe
@endcomponent

@endcomponent
