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
												<div class="aside"><img src="{{ asset('frontend/cssfiles/images/items/1.jpg') }}" class="img-sm"></div>
												<figcaption class="info">

													<a href="#" class="title text-dark">{{ Str::words($item->name,20) }}</a>
                                                    @foreach($item->attributes as $key  => $value)
                                                        <dl class="dlist-inline small">
                                                            <dt>Size: {{ ucwords($key) }}: </dt>
                                                            <dd>Value: {{ ucwords($value) }}</dd>
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

<div class="alert alert-success mt-3">
	<p class="icontext"><i class="icon text-success fa fa-truck"></i> Free Delivery within 1-2 weeks</p>
</div>

	</main> <!-- col.// -->
	<aside class="col-md-3">
		<div class="card mb-3">
			<div class="card-body">
			<form>
				<div class="form-group">
					<label>Have coupon?</label>
					<div class="input-group">
						<input type="text" class="form-control" name="" placeholder="Coupon code">
						<span class="input-group-append"> 
							<button class="btn btn-primary">Apply</button>
						</span>
					</div>
				</div>
			</form>
			</div> <!-- card-body.// -->
		</div>  <!-- card .// -->
		<div class="card">
			<div class="card-body">
					<dl class="dlist-align">
					  <dt>Total price:</dt>
					  <dd class="text-right">USD 568</dd>
					</dl>
					<dl class="dlist-align">
					  <dt>Discount:</dt>
					  <dd class="text-right">USD 658</dd>
					</dl>
					<dl class="dlist-align">
					  <dt>Total:</dt>
					  <dd class="text-right  h5"><strong>{{ config('settings.currency_symbol') }}{{ \Cart::getSubTotal() }}</strong></dd>
					</dl>
					<hr>
					<p class="text-center mb-3">
						<img src="{{ asset('frontend/cssfiles/images/misc/payments.png') }}" height="26">
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
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

</div><!-- container // -->
</section>
<!-- ========================= SECTION  END// ========================= -->
@stop
