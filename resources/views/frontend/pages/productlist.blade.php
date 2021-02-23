@extends('frontend.app')
@section('content')

<!-- ========================= SECTION PAGETOP ========================= -->
<section class="section-pagetop bg">
<div class="container">
	<h2 class="title-page"> products</h2>
	<nav>
	{{ Breadcrumbs::render('shop') }}
	</nav>
</div> <!-- container //  -->
</section>
<!-- ========================= SECTION INTRO END// ========================= -->

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
<div class="container">

<div class="row">
	<aside class="col-md-3">
		
<div class="card">
	<article class="filter-group">
		<header class="card-header">
			<a href="#" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true" class="">
				<i class="icon-control fa fa-chevron-down"></i>
				<h6 class="title">Category type</h6>
			</a>
		</header>
		<div class="filter-content collapse show" id="collapse_1" style="">
			<div class="card-body">
				<form class="pb-3" action="{{ route('product.search') }}" method="post" autocomplete="off">
					@csrf
				<div class="input-group">
				  <input type="text" class="form-control" id="searchshop" placeholder="Search an item" name="item">
				  <div class="input-group-append">
				    <button class="btn btn-light" type="submit"><i class="fa fa-search"></i></button>
				  </div>
				</div>
				</form>

				<ul class="list-menu">
					@foreach($cats as $cat)
								<li><a href="{{ route('category.show.product', $cat->slug) }}">{{ $cat->name }}</a></li>
					@endforeach
				</ul>

			</div> <!-- card-body.// -->
		</div>
	</article> <!-- filter-group  .// -->
</div> <!-- card.// -->

	</aside> <!-- col.// -->
	<main class="col-md-9">

<div class="row">

@forelse($products as $item)
	<div class="col-md-4">
		<figure class="card card-product-grid">
			<div class="img-wrap"> 
						@if(empty($item->images->first()->full))
							<a href="" data-fancybox data-caption="{{ asset('frontend/cssfiles/images/image-not-available.png') }}" class="img-wrap"><img src=""></a>
						@else
							<img src="{{ asset('storage/'.$item->images->first()->full )}}" >
						@endif
				<a class="btn-overlay" href="#"><i class="fa fa-search-plus"></i> Quick view</a>
			</div> <!-- img-wrap.// -->
			<figcaption class="info-wrap">
				<div class="fix-height">
					<a href="#" class="title">{{$item->slug}}</a>
					<div class="price-wrap mt-2">
						<span class="price">{{ config('settings.currency_symbol') }} {{$item->price}}</span>
						<del class="price-old">per item</del>
					</div> <!-- price-wrap.// -->
				</div>
				<a href="{{ route('product.show', $item->slug) }}" class="btn btn-block btn-primary">View Details </a>
			</figcaption>
		</figure>
	</div> <!-- col.// -->
@empty
	<div class="alert alert-warning" role="alert">
		Theres no more products in this Category. Click <a href="{{route('shop')}}" class="alert-link">Here</a>, to view other products.
	</div>
@endforelse

</div> <!-- row end.// -->

<div class="d-flex justify-content-center">
    	{!! $products->links() !!}
	</div>
	</main> <!-- col.// -->

</div>

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
<!-- =============== SECTION SERVICES =============== -->
<section  class="padding-bottom">
<header class="section-heading heading-line">
	<h5 class="title-section text-uppercase">How to place and order	</h5>
</header>
<div class="container">

<!-- ============================ COMPONENT 1 ================================= -->
<div class="row">
<div class="col-md-3 mb15">
	<article class="card card-body">
		<figure class="text-center">
			<span class="rounded-circle icon-md "><i class="fas fa-columns"></i></span>
			<figcaption class="pt-4">
			<h5 class="title">Browse through items</h5>
			<p>Look through the items on categories or shop section </p>
			</figcaption>
		</figure> <!-- iconbox // -->
	</article> <!-- panel-lg.// -->
</div><!-- col // -->
<div class="col-md-3 mb15">
	<article class="card card-body">
		<figure class="text-center">
			<span class="rounded-circle icon-md "><i class="fas fa-shopping-cart"></i></i></span>
			<figcaption class="pt-4">
			<h5 class="title">View your Cart</h5>
			<p>Once selected review your items on your cart </p>
			</figcaption>
		</figure> <!-- iconbox // -->
	</article> <!-- panel-lg.// -->
</div> <!-- col // -->
<div class="col-md-3 mb15">
	<article class="card card-body">
		<figure class="text-center">
			<span class="rounded-circle icon-md "><i class="fas fa-shopping-bag"></i></span>
			<figcaption class="pt-4">
			<h5 class="title">Proceed to checkout</h5>
			<p>Once items verified make purchase and head to checkout</p>
			</figcaption>
		</figure> <!-- iconbox // -->
	</article> <!-- panel-lg.// -->
</div> <!-- col // -->
<div class="col-md-3 mb15">
	<article class="card card-body">
		<figure class="text-center">
			<span class="rounded-circle icon-md "><i class="far fa-paper-plane"></i></span>
			<figcaption class="pt-4">
			<h5 class="title">Place your Order</h5>
			<p>Confirm and fill in your contact details and place your order </p>
			</figcaption>
		</figure> <!-- iconbox // -->
	</article> <!-- panel-lg.// -->
</div> <!-- col // -->
</div>
<!-- ============================ COMPONENT 1 END .// ================================= -->
</div>

</section>
<!-- =============== SECTION SERVICES .//END =============== -->

@stop
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
    var route = "{{ url('autocomplete') }}";
    $('#searchshop').typeahead({
        source:  function (term, process) {
        return $.get(route, { term: term }, function (data) {
                return process(data);
            });
        }
    });
</script>
@endpush
