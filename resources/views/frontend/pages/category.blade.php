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

		<div class="col-md-3">
			<div class="card card-category">

			  <div class="img-wrap" style="background: #ffd7d7">
			  	<img src="{{ asset('frontend/cssfiles/images/items/1.jpg') }}">
			  </div>
			  <div class="card-body">
			    <h4 class="card-title"><a href="#">Categoty Name</a></h4>
			    <ul class="list-menu">
			    	<li><a href="">Unisex T shirts</a></li>
					<li><a href="">Casual shirts</a></li>
					<li><a href="">Scherf Ice cream</a></li>
					<li><a href="">Another category</a></li>
					<li><a href="">Great items name</a></li>
					<li><a href="">Great items name</a></li>

			    </ul>
			  </div>

			</div>
		</div> <!-- col.// -->


				@foreach($cats as $cat)
				<div class="col-md-3">
					<div class="card card-category">
						@foreach($cat->items as $category)
							@if ($category->items->count() > 0)

								<div class="img-wrap" style="background: #ffd7d7">
									<img src="{{ asset('storage/'.$category->image) }}">
								</div>
								<div class="card-body">
									<h4 class="card-title"><a href="{{ route('category.show', $category->slug) }}">{{$category->name}}</a></h4>
									<ul class="list-menu" aria-labelledby="{{ $category->slug }}">
										@foreach($category->items as $item)
											<li><a href="{{ route('category.show', $item->slug) }}">{{ $item->name }}</a></li>
										@endforeach
									</ul>
								</div>
								
							@else

								<div class="img-wrap" style="background: #ffd7d7">
								@if ($category->image != null)
								<img src="{{ asset('storage/'.$category->image) }}" alt="img">
								@else
								<img src="{{ asset('frontend/cssfiles/images/avatars/avatarimg.png') }}" class="">
								@endif
								</div>
								
								<div class="card-body">
									<h4 class="card-title"><a href="{{ route('category.show', $category->slug) }}">{{$category->name}}</a></h4>
								</div>

							@endif
						@endforeach
					</div>
				</div> <!-- col.// -->
				@endforeach
				
	</nav> <!-- row.// -->


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