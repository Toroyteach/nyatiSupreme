@component('mail::message')
# Greetings {{ $user }}

Welcome to Nyati Supreme Delivery where we get you good stuff

@component('mail::button', ['url' => 'nyatisupreme.co.ke'])
OPEN WEBSITE
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent