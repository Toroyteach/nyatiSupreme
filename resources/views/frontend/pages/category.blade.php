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
										<img src="{{ asset('storage/'.$category->image) }}">
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
									<img src="{{ asset('storage/'.$category->image) }}" alt="img">
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


@stop