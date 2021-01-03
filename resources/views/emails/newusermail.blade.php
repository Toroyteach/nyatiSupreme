@component('mail::message')
# Greetings {{ $user }}

Welcome to Nyati Supreme Delivery where we get you good stuff

@component('mail::button', ['url' => 'google.com'])
OPEN WEBSITE
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent