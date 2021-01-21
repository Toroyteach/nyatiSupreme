@component('mail::newOrder')

@slot('name')
{{$orderData['first_name']}}
@endslot

@slot('orderNumber')
{{$orderData['order_number']}}
@endslot

@slot('subTotal')
@endslot

@slot('shippingFee')
@endslot

@slot('tax')
@endslot

@slot('grandTotal')
{{$orderData['grand_total']}}
@endslot

@slot('deliveryAddress')
{{$orderData['address']}}<br>
{{$orderData['city']}}<br>
{{$orderData['post_code']}}<br>
@endslot


@endcomponent