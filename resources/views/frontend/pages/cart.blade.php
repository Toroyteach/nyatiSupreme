@extends('frontend.app')
@section('content')

    <!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
<div class="container">
<div class="row">
                <div class="col-sm-12">
                    @if (Session::has('message'))
                        <p class="alert alert-success">{{ Session::get('message') }}</p>
                    @endif
                </div>
            </div>
	<nav>
		{{ Breadcrumbs::render('cart') }}
	</nav>
<div class="row">
	<main class="col-md-9">
<div class="card">

<tr>

	@if (\Cart::isEmpty())
                        <p class="alert alert-warning">Your shopping cart is empty.</p>
                    @else
                        <div class="card">
						<table class="table table-responsive-md table-responsive-lg table-responsive-xl table-responsive-sm table-borderless table-shopping-cart">
							<thead class="text-muted">
							<tr class="small text-uppercase">
							<th scope="col">Product</th>
							<th scope="col" width="120">Quantity</th>
							<th scope="col" width="120">Price</th>
							<th scope="col" class="text-right" width="200"></th>
							</tr>
							</thead>
							<tbody>
                                @foreach(\Cart::getContent() as $item)
                                    <tr>
                                        <td>

											<figure class="itemside">
												<div class="aside"><img src="{{ asset('storage/'.$item->associatedModel->images->first()->full )}}" class="img-sm" ></div>
												<figcaption class="info">

												{{ Str::words($item->name,20) }}
                                                    @foreach($item->attributes as $key  => $value)
                                                        <dl class="dlist-inline small">
                                                            <dt> {{ ucwords($key) }}: </dt> <dd>{{ ucwords($value) }}</dd>
                                                        </dl>
                                                    @endforeach
												</figcaption>
											</figure>

                                        </td>

                                        <td>
                                            <var class="price">{{ $item->quantity }}</var>
                                        </td>
                                        <td>
                                            <div class="price-wrap">
                                                <var class="price">{{ config('settings.currency_symbol'). $item->price }}</var>
                                                <small class="text-muted">each</small>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('checkout.cart.remove', $item->id) }}" class="btn btn-outline-danger"><i class="fa fa-times"></i> </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

</tr>

</tbody>
</table>

<div class="card-body border-top">
	<a href="{{ route('checkout.index') }}" class="btn btn-primary float-sm-left float-md-left float-lg-left float-xl-left">Make Purchase<i class="fa fa-chevron-right"></i> </a>
	<a href="{{ route('home') }}" class="btn btn-light float-sm-right float-md-right float-lg-right float-xl-right"> <i class="fa fa-chevron-left"></i>Back shopping</a>
</div>	
</div> <!-- card.// -->

<!-- <div class="alert alert-success mt-3">
	<p class="icontext"><i class="icon text-success fa fa-truck"></i> Free Delivery within 1-2 weeks</p>
</div> -->

	</main> <!-- col.// -->
	<aside class="col-md-3">
		<div class="card">
			<div class="card-body">
					<dl class="dlist-align">
					  <dt>Total:</dt>
					  <dd class="text-right">{{ config('settings.currency_symbol') }} {{ \Cart::getTotal() }}</dd>
					</dl>
					<dl class="dlist-align">
					  <dt>Shipping fee:</dt>
					  <dd class="text-right">{{ config('settings.currency_symbol') }} {{ config('settings.shipping_fee') }}</dd>
					</dl>
					<dl class="dlist-align">
					  <dt>Sub Total:</dt>
					  <dd class="text-right  h5"><strong>{{ config('settings.currency_symbol') }} {{ \Cart::getSubTotal() }}</strong></dd>
					</dl>
					<hr>
					<!-- <a href="{{ route('checkout.index') }}" class="btn btn-primary">Clear Cart</a> -->
					<p class="text-center mb-3">
						<img src="{{ asset('frontend/cssfiles/images/misc/pament_edited.png') }}" >
					</p>
					
			</div> <!-- card-body.// -->
		</div>  <!-- card .// -->
	</aside> <!-- col.// -->
</div>

</div> <!-- container .//  -->
</section>

<!-- ========================= SECTION CONTENT END// ========================= -->

<!-- ========================= SECTION  ========================= -->
<section class="section-name border-top padding-y">
<div class="container">
<h6>Payment and refund policy</h6>
<p> {{ config('settings.payment_policy') }}</p>

</div><!-- container // -->
</section>
<!-- ========================= SECTION  END// ========================= -->
<!-- ============================ COMPONENT 3 ================================= -->
<section class="section-content padding-y bg">
<div class="container">
<article class="card card-body">


<div class="row">
	<div class="col-md-4">	
		<figure>
			<span class="text-primary"><i class="fa fa-2x fa-truck"></i></span>
			<figcaption class="pt-3">
				<h5 class="title">Fast delivery</h5>
				<p>We deliver our products and services with most urgency and as soon as you place your order</p>
			</figcaption>
		</figure> <!-- iconbox // -->
	</div><!-- col // -->
	<div class="col-md-4">
		<figure>
			<span class="text-primary"><i class="fa fa-2x fa-landmark"></i></span>	
			<figcaption class="pt-3">
				<h5 class="title">Creative Strategy</h5>
				<p>We liase with you our customer to see how we can effectively deliver your products
				 </p>
			</figcaption>
		</figure> <!-- iconbox // -->
	</div><!-- col // -->
    <div class="col-md-4">
		<figure>
			<span class="text-primary"><i class="fa fa-2x fa-lock"></i></span>
			<figcaption class="pt-3">
				<h5 class="title">High secured </h5>
				<p>We guarantee you our customer your order will arrive safe and secured.
				 </p>
			</figcaption>
		</figure> <!-- iconbox // -->
	</div> <!-- col // -->
</div>
</article> <!-- card.// -->
</div> <!-- container .//  -->
</section>
<!-- ============================ COMPONENT 3 END .// ================================= -->
@stop
