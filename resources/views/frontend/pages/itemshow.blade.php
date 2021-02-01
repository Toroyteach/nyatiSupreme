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
				<form class="pb-3">
				<div class="input-group">
				  <input type="text" class="form-control" placeholder="Search">
				  <div class="input-group-append">
				    <button class="btn btn-light" type="button"><i class="fa fa-search"></i></button>
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


	</aside> <!-- col.// -->
	<main class="col-md-9">

	@forelse($catItems as $cat)
		@forelse($cat->products as $key => $prodItems)
		
		<article class="card card-product-list">
				<div class="row no-gutters">
					<aside class="col-md-3">
						<a href="" class="img-wrap"><img src="{{ asset('storage/'.$prodItems->images->first()) }}"></a>
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
								<div class="label-rating">7/10</div>
							</div> <!-- rating-wrap.// -->
							
							<p> {{$prodItems->description}}</p>
						</div> <!-- info-main.// -->
					</div> <!-- col.// -->
					<aside class="col-sm-3">
						<div class="info-aside">
							<div class="price-wrap">
								<span class="price h5"> $62 </span>	
							</div> <!-- info-price-detail // -->
							<p class="text-success">Free shipping</p>
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

<!-- ========================= SECTION  ========================= -->
<section class="section-name padding-y bg">
<div class="container">

<div class="row">
	<div class="col-md-8">
		<h5 class="title-description">Description</h5>
		<p> </p>
		<ul class="list-check">
		<li>Material: Stainless steel</li>
		<li>Weight: 82kg</li>
		<li>built-in drip tray</li>
		<li>Open base for pots and pans</li>
		<li>On request available in propane execution</li>
		</ul>

		<h5 class="title-description">Specifications</h5>
		<table class="table table-bordered">
			<tr> <th colspan="2">Basic specs</th> </tr>
			<tr> <td>Type of energy</td><td>Lava stone</td> </tr>
			<tr> <td>Number of zones</td><td>2</td> </tr>
			<tr> <td>Automatic connection	</td> <td> <i class="fa fa-check text-success"></i> Yes </td></tr>

			<tr> <th colspan="2">Dimensions</th> </tr>
			<tr> <td>Width</td><td>500mm</td> </tr>
			<tr> <td>Depth</td><td>400mm</td> </tr>
			<tr> <td>Height	</td><td>700mm</td> </tr>

			<tr> <th colspan="2">Materials</th> </tr>
			<tr> <td>Exterior</td><td>Stainless steel</td> </tr>
			<tr> <td>Interior</td><td>Iron</td> </tr>

			<tr> <th colspan="2">Connections</th> </tr>
			<tr> <td>Heating Type</td><td>Gas</td> </tr>
			<tr> <td>Connected load gas</td><td>15 Kw</td> </tr>

		</table>
	</div> <!-- col.// -->
	
</div> <!-- row.// -->

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->



<!-- ========================= SECTION SUBSCRIBE  ========================= -->
<section class="padding-y-lg bg-light border-top">
<div class="container">

<p class="pb-2 text-center">Delivering the latest product trends and industry news straight to your inbox</p>

<div class="row justify-content-md-center">
  <div class="col-lg-4 col-sm-6">
<form class="form-row">
    <div class="col-8">
    <input class="form-control" placeholder="Your Email" type="email">
    </div> <!-- col.// -->
    <div class="col-4">
    <button type="submit" class="btn btn-block btn-warning"> <i class="fa fa-envelope"></i> Subscribe </button>
    </div> <!-- col.// -->
</form>
<small class="form-text">We’ll never share your email address with a third-party. </small>
  </div> <!-- col-md-6.// -->
</div>
  

</div>
</section>
<!-- ========================= SECTION SUBSCRIBE END// ========================= -->

@stop