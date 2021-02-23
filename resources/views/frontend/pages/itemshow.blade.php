@extends('frontend.app')
@section('content')

<!-- ========================= SECTION PAGETOP ========================= -->
<section class="section-pagetop bg">
<div class="container">
	<h2 class="title-page">{{$title}}</h2>
	<nav>
	{{ Breadcrumbs::render('category') }}
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
				<h6 class="title">Other Categories</h6>
			</a>
		</header>
		<div class="filter-content collapse show" id="collapse_1" style="">
			<div class="card-body">
				<!-- <form class="pb-3">
				<div class="input-group">
				  <input type="text" class="form-control" placeholder="Search">
				  <div class="input-group-append">
				    <button class="btn btn-light" type="button"><i class="fa fa-search"></i></button>
				  </div>
				</div>
				</form> -->
				
				<ul class="list-menu">
					@foreach($cats as $cat)
								<li><a href="{{ route('category.show.product', $cat->slug) }}">{{ $cat->name }}</a></li>
					@endforeach
				</ul>

			</div> <!-- card-body.// -->
		</div>
	</article> <!-- filter-group  .// -->


	</aside> <!-- col.// -->
	<main class="col-md-9">

	@forelse($catItems as $cat)
		@forelse($cat->products as $key => $prodItems)
		
		<article class="card card-product-list">
				<div class="row no-gutters">
					<aside class="col-md-3">
						@if(empty($prodItems->images->first()->full))
							<a href="" data-fancybox data-caption="{{ asset('frontend/cssfiles/images/image-not-available.png') }}" class="img-wrap"><img src=""></a>
						@else
							<a href="" class="img-wrap"><img src="{{ asset('storage/'.$prodItems->images->first()->full) }}"></a>
						@endif
					</aside> <!-- col.// -->
					<div class="col-md-6">
						<div class="info-main">
							<a href="#" class="h5 title"> {{$prodItems->slug}}  </a>
							<div class="rating-wrap mb-3">
								<ul class="rating-stars">
									<li style="width:80%" class="stars-active"> 
										<i class="fa fa-star"></i> <i class="fa fa-star"></i> 
										<i class="fa fa-star"></i> <i class="fa fa-star"></i> 
										<i class="fa fa-star"></i> 
									</li>
									<li>
										<i class="fa fa-star"></i> <i class="fa fa-star"></i> 
										<i class="fa fa-star"></i> <i class="fa fa-star"></i> 
										<i class="fa fa-star"></i> 
									</li>
								</ul>
								<!-- <div class="label-rating">7/10</div> -->
							</div> <!-- rating-wrap.// -->
							
							<p> {{$prodItems->description}}</p>
						</div> <!-- info-main.// -->
					</div> <!-- col.// -->
					<aside class="col-sm-3">
						<div class="info-aside">
							<br>
							<p>
								<a href="{{ route('product.show', $prodItems->slug) }}" class="btn btn-primary btn-block"> Details </a>
							</p>
						</div> <!-- info-aside.// -->
					</aside> <!-- col.// -->
				</div> <!-- row.// -->
			</article> <!-- card-product .// -->
		@empty
		<div class="alert alert-warning" role="alert">
			Theres no more products in this Category. Click <a href="{{route('shop')}}" class="alert-link">Here</a>. To view other products.
		</div>


		@endforelse
	@empty
	<div class="alert alert-warning" role="alert">
		Theres no more products in this Category. Click <a href="{{route('shop')}}" class="alert-link">Here</a>. To view other products.
	</div>
	@endforelse


<div class="d-flex justify-content-center">

	</div>

	</main> <!-- col.// -->

</div>

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->

<section class="section-content padding-y">
<div class="container col-md-9 col-xl-7 col-lg-7 mx-auto">
<h4>Images of {{$title}}</h4>

<!-- ================== COMPONENT SLIDER  BOOTSTRAP  ==================  -->
<div id="carousel1_indicator" class="slider-home-banner carousel slide" data-ride="carousel">

  <div class="carousel-inner">

  @forelse($catItems as $cat)
		@forelse($cat->products as $key => $prodItems)
			@if($key == 0)
			<div class="carousel-item active">
			<img src="{{ asset('storage/'.$prodItems->images->first()->full) }}" alt="image slide"> 
			<div class="carousel-caption d-inline p-2 bg-secondary text-white">
					<h5 class="lead">{{$prodItems->name}}</h5>
					<!-- <p class="lead">{{$prodItems->description}}</p> -->
			</div>
			</div>
			@else
			@endif
				
					@if($prodItems->images->count() > 0)

						@forelse($prodItems->images as $key => $prodItemsImages)

						<div class="carousel-item">
						<img src="{{ asset('storage/'.$prodItemsImages->full) }}" alt="image slide"> 
						<div class="carousel-caption d-inline p-2 bg-secondary text-white">
								<h5 class="lead">{{$prodItems->name}}</h5>
								<!-- <p class="lead">{{$prodItems->description}}</p> -->
						</div>
						</div>
						@empty
						@endforelse

					@else

						<div class="carousel-item">
						<img src="{{ asset('storage/'.$prodItems->images->first()->full) }}" alt="image slide"> 
						<div class="carousel-caption d-inline p-2 bg-secondary text-white">
								<h5 class="lead">{{$prodItems->name}}</h5>
								<!-- <p class="lead">{{$prodItems->description}}</p> -->
						</div>
						</div>

					@endif

		@empty
		@endforelse
  @empty
  @endforelse



  </div>
  <a class="carousel-control-prev" href="#carousel1_indicator" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel1_indicator" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div> 
<!-- ==================  COMPONENT SLIDER BOOTSTRAP end.// ==================  .// -->	

</div> <!-- container .//  -->
</section>


@stop