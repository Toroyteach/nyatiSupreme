@extends('frontend.app')
@section('content')
    <!-- ========================= SECTION PAGETOP ========================= -->
<section class="section-pagetop bg-gray">
<div class="container">
	<h2 class="title-page">My accountt</h2>
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

		<article class="card mb-3">
			<div class="card-body">
				
				<figure class="icontext">
						<div class="icon">
							@if ($user->profile_image != null)
									@if($user->social != null)
									<img src="{{ asset('storage/'. Auth::user()->profile_image) }}" class="rounded-circle img-sm border" alt="img">
									@else
									<img src="{{ (Auth::user()->profile_image) }}" class="rounded-circle img-sm border" alt="img">
									@endif
								@else
								<img src="{{ asset('frontend/cssfiles/images/avatars/avatarimg.png') }}" class="rounded-circle img-sm border">
							@endif
						</div>
						<div class="text">
							<strong> {{$user->getFullNameAttribute()}} </strong> <br> 
							<p class="mb-2"> {{$user->email}}  </p> 
							<a href="{{ route('account.settings') }}" class="btn btn-light btn-sm">Edit</a>
						</div>
				</figure>
				<hr>
				<p>
					<i class="fa fa-map-marker text-muted"></i> &nbsp; My address:  
					 <br>
					{{$user->address}} 
					<a href="{{ route('account.address') }}" class="btn-link"> Edit</a>
				</p>

				

				<article class="card-group card-stat">
					<figure class="card bg">
						<div class="p-3">
							 <h4 class="title">{{$orderscount}}</h4>
							<span>Orders</span>
						</div>
					</figure>
					<figure class="card bg">
						<div class="p-3">
							 <h4 class="title">{{$pendingOrders}}</h4>
							<span>Pending Orders</span>
						</div>
					</figure>
					<figure class="card bg">
						<div class="p-3">
							 <h4 class="title">{{$completeOrders}}</h4>
							<span>Completed Orders</span>
						</div>
					</figure>
				</article>
				

			</div> <!-- card-body .// -->
		</article> <!-- card.// -->

		<article class="card  mb-3">
			<div class="card-body">
				<h5 class="card-title mb-4">Recent orders </h5>	

				<div class="row">
	
				@forelse ($orders as $key => $order)

				<div class="col-md-6">
					<figure class="itemside  mb-3">
						<figcaption class="info">
							<time class="text-muted"><i class="fa fa-calendar-alt"></i> {{ Carbon\Carbon::parse($order->created_at)}}</time>
							<p>{{$order->order_number}}</p>
									
									@switch($order->status)
										@case('completed')
										<span class="badge badge-success">Completed</span>
											@break

										@case('processing')
										<span class="badge badge-primary">Processing</span>
											@break

										@case('pending')
										<span class="badge badge-warning">Pending</span>
											@break

										@default
										<span class="badge badge-warning">Pending</span>
									@endswitch

						</figcaption>
					</figure>
				</div> <!-- col.// -->
				@empty
				<div class="alert alert-warning" role="alert">
					You dont have any Orders yet. Click <a href="{{route('shop')}}" class="alert-link">Here</a>. To View products and place an Order.
				</div>
				@endforelse



			</div> <!-- row.// -->

			<a href="{{ route('account.orders') }}" class="btn btn-outline-primary btn-block"> See all orders  </a>
			</div> <!-- card-body .// -->
		</article> <!-- card.// -->

	</main> <!-- col.// -->
</div>

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
@stop
