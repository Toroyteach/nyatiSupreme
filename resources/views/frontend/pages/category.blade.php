@extends('frontend.app')
@section('content')
    <!-- ========================= SECTION CONTENT ========================= -->
	<section class="section-pagetop bg">
<div class="container">
	<h2 class="title-page"> Categories</h2>
	<nav>
	{{ Breadcrumbs::render('category') }}
	</nav>
</div> <!-- container //  -->
</section>
<section class="section-content padding-y">
<div class="container">

	<nav class="row">


		@forelse($cats as $cat)
			@foreach($cat->items as $category)
				<div class="col-md-3 col-sm-12 col-lg-3 col-xl-3">
						@if ($category->items->count() > 0)
							<div class="card card-category">

								<div class="img-wrap" style="">
												@if(empty($category->image))
													<a href="" data-fancybox data-caption="{{ asset('frontend/cssfiles/images/image-not-available.png') }}" class="img-wrap"><img src=""></a>
												@else
												<a href="{{ asset('storage/'.$category->image) }}" data-fancybox data-caption="{{ $category->description }}" class="img-wrap"><img src="{{ asset('storage/'.$category->image) }}"></a>
												@endif
								</div>
								<div class="card-body">
									<h4 class="card-title"><a href="{{ route('category.show.product', $category->slug) }}">{{$category->name}}</a></h4>
									<ul class="list-menu" aria-labelledby="{{ $category->slug }}">
										@foreach($category->items as $item)
											<li><a href="{{ route('category.show.product', $item->slug) }}">{{ $item->name }}</a></li>
										@endforeach
									</ul>
								</div>
							</div>
									
						@else
							<div class="card card-category">
								<div class="img-wrap" style="">
									@if ($category->image != null)
									<a href="{{ asset('storage/'.$category->image) }}" data-fancybox data-caption="{{ $category->description }}" class="img-wrap"><img src="{{ asset('storage/'.$category->image) }}"></a>

									@else
									<img src="{{ asset('frontend/cssfiles/images/avatars/avatarimg.png') }}" class="">
									@endif
								</div>
									
									<div class="card-body">
										<h4 class="card-title"><a href="{{ route('category.show.product', $category->slug) }}">{{$category->name}}</a></h4>
									</div>

							</div>
						@endif
				</div> <!-- col.// -->
			@endforeach
		@empty
		<div class="alert alert-warning" role="alert">
					Theres no more Category.
				</div>
		@endforelse



				
	</nav> <!-- row.// -->


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