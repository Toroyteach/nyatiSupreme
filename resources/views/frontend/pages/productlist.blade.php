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
				  <input type="text" class="form-control" id="searchshop" placeholder="Search an item" name="itemshop">
				  <div class="input-group-append">
				    <button class="btn btn-light" type="button"><i class="fa fa-search"></i></button>
				  </div>
				</div>
				</form>

				<ul class="list-menu">
					@foreach($cats as $cat)
						@foreach($cat->items as $category)
								<li><a href="{{ route('category.show.product', $category->slug) }}">{{ $category->name }}</a></li>
						@endforeach
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
				<img src="{{ asset('storage/'.$item->images->first()->full )}}" >
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
