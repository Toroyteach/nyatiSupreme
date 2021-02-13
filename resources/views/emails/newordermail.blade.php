@component('mail::newOrder')

@slot('name')
{{$orderData['first_name']}}
@endslot

@slot('orderNumber')
{{$orderData['order_number']}}
@endslot

@slot('shippingFee')
{{$orderData['shipping_fee']}}
@endslot

@slot('count')
{{$orderData['item_count']}}
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