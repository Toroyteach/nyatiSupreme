@component('mail::message')
# Greetings

The following products have critical low count.
Please take action!!

{{$mailData}}

@component('mail::button', ['url' => 'nyatisupreme.co.ke'])
OPEN WEBSITE
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent