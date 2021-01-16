@component('mail::newOrder')

@slot('name')
{{$orderDetails->first_name}}
@endslot

@slot('orderNumber')
{{$orderDetails->order_number}}
@endslot

@slot('subTotal')
@endslot

@slot('shippingFee')
@endslot

@slot('tax')
@endslot

@slot('grandTotal')
{{$orderDetails->grand_total}}
@endslot

@slot('deliveryAddress')
{{$orderDetails->address}}
{{$orderDetails->city}}
{{$orderDetails->post_code}}
@endslot


@endcomponent