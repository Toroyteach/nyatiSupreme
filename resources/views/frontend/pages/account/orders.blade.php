@extends('frontend.app')
@section('content')
    <!-- ========================= SECTION PAGETOP ========================= -->
<section class="section-pagetop bg-gray">
<div class="container">
	<h2 class="title-page">My account</h2>
</div> <!-- container //  -->
</section>
<!-- ========================= SECTION PAGETOP END// ========================= -->
	

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
<div class="container">

<div class="row">
	<aside class="col-md-3">
    @include('frontend.pages.account.nav.nav')
	</aside> <!-- col.// -->
	<main class="col-md-9">

	@foreach($orders as $data)	
	<article class="card mb-4">
		<header class="card-header">
			<strong class="d-inline-block mr-3">Order ID: {{ $data->order_number }}</strong>
			<span>Order Date: {{ Carbon\Carbon::parse($data->created_at) }}</span>
			<span>Items Count: {{ $data->item_count }}</span>
		</header>
		<div class="card-body">
			<div class="row"> 
				<div class="col-md-8">
					<h6 class="text-muted">Delivery to</h6>
					<p>{{ $data->user->getFullNameAttribute() }} <br>  
					Phone: {{ $data->phone_number }} Email: {{ $data->user->email }} <br>
					Town: {{ $data->city }}, <br>
					Post Code: {{ $data->post_code }}, <br> 
			    	P.O. Box: {{ $data->address }} <br>
			 		</p>
				</div>
				<div class="col-md-4">
					<h6 class="text-muted">Payment</h6>
					<span class="text-success">

									@switch($data->payment_method)
										@case('mpesa')
										<img src="{{ asset('frontend/cssfiles/images/icons/mpesa.svg') }}" class="img-fluid" style="height:30px;width:auto;" alt="img">
											@break

										@case('credit')
										<i class="fa fa-credit-card"></i>
											@break

										@default
										<i class="fas fa-money-check"></i>
									@endswitch

					</span>
					<p>Subtotal: {{ config('settings.currency_symbol'). $data->grand_total }} <br>
					 Shipping fee:  {{ config('settings.currency_symbol'). $data->shipping_fee }} <br> 
					 <span class="b">Total:  {{ config('settings.currency_symbol'). $data->grand_total }} </span>
					</p>
				</div>
			</div> <!-- row.// -->
		</div> <!-- card-body .// -->
		<div class="table-responsive">
			<p>  Order Items</p>
		<table class="table table-hover">
		
			<tbody>
			@foreach($data->items as $key => $dataItem)
			<tr>
				<td width="75">
					<img src="{{ asset('storage/'. $dataItem->product->images->first()->full) }}" class="img-sm border" alt="img">
				</td>
				<td>
					<p class="title mb-0">Id: {{ $key++ }}</p>
					<p class="title mb-0">Item Name: {{ $dataItem->product->name }}</p>
					<p class="title mb-0">Quantity: {{ $dataItem->quantity }}</p>
					<var class="price text-muted">{{ config('settings.currency_symbol'). $dataItem->price }}</var>
				</td>
			</tr>

			@endforeach
		</tbody>

		</table>
		</div> <!-- table-responsive .end// -->
		</article> <!-- card order-item .// -->
	@endforeach

	<div class="d-flex justify-content-center">
    	{!! $orders->links() !!}
	</div>

	</main> <!-- col.// -->
</div>

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
@stop
