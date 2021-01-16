@component('mail::message')
# Greetings

The following products have critical low count.
Please take action!!

@component('mail::table')
| id | name | price | qty | subtotal |
| -- |:----:| -----:| ---:| --------:|
@foreach($order->cart as $item)
  // create table rows
@endforeach
@endcomponent

@component('mail::button', ['url' => 'nyatisupreme.co.ke'])
OPEN WEBSITE
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent