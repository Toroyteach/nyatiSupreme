@component('mail::message')
# Greetings {{ $orderData['first_name']}}

We would like to inform you that your order has been received
and place with the order id {{ $orderData['order_number']}}

and a grand total of ksh{{$orderData['grand_total']}}

@component('mail::button', ['url' => 'google.com'])
OPEN WEBSITE
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent