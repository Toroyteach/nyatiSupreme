@component('mail::message')
# Greetings {{ $orderData['first_name']}}

We would like to inform you that your order status 
has changed to {{ $orderData['status']}}

@component('mail::button', ['url' => 'google.com'])
OPEN WEBSITE
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent