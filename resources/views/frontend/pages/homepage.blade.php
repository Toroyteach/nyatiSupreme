@extends('frontend.app')
@section('content')
@if (session('subscribed'))
    <div class="alert alert-success">
        {{ session('subscribed') }}
    </div>
@endif
<div class="container">
<!-- ========================= SECTION MAIN  ========================= -->
<section class="section-main padding-y">
<main class="card">
	<div class="card-body">

<div class="row">
	<aside class="col-lg col-md-3 flex-lg-grow-0">
		<nav class="nav-home-aside">
			<h6 class="title-category">	CATEGORIES <i class="d-md-none icon fa fa-chevron-down"></i></h6>
			<ul class="menu-category">


                @forelse($categories as $cat)
                    @foreach($cat->items as $category)
						@if ($category->items->count() > 0)
						<li class="has-submenu"><a href="{{ route('category.show.product', $category->slug) }}">{{ $category->name }}</a>
							<ul class="submenu">
							@foreach($category->items as $item)
								<li><a class="dropdown-item" href="{{ route('category.show.product', $item->slug) }}">{{ $item->name }}</a></li>
                                    @endforeach
							</ul>
						</li>
                        @else
							<li><a class="nav-link" href="{{ route('category.show.product', $category->slug) }}">{{ $category->name }}</a></li>
                        @endif
                    @endforeach
				@empty
				<div class="alert alert-warning" role="alert">
					Theres no Category.
				</div>
				@endforelse

			</ul>
		</nav>
	</aside> <!-- col.// -->
	<div class="col-md-9 col-xl-7 col-lg-7">

<!-- ================== COMPONENT SLIDER  BOOTSTRAP  ==================  -->
<div id="carousel1_indicator" class="slider-home-banner carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carousel1_indicator" data-slide-to="0" class="active"></li>
    <li data-target="#carousel1_indicator" data-slide-to="1"></li>
	<li data-target="#carousel1_indicator" data-slide-to="2"></li>
	<li data-target="#carousel1_indicator" data-slide-to="3"></li>
	<li data-target="#carousel1_indicator" data-slide-to="4"></li>
	<li data-target="#carousel1_indicator" data-slide-to="5"></li>
	<li data-target="#carousel1_indicator" data-slide-to="6"></li>
	<li data-target="#carousel1_indicator" data-slide-to="7"></li>
	<li data-target="#carousel1_indicator" data-slide-to="8"></li>
	<li data-target="#carousel1_indicator" data-slide-to="9"></li>
	<li data-target="#carousel1_indicator" data-slide-to="10"></li>
	<li data-target="#carousel1_indicator" data-slide-to="11"></li>
	<li data-target="#carousel1_indicator" data-slide-to="12"></li>
	<li data-target="#carousel1_indicator" data-slide-to="13"></li>
	<li data-target="#carousel1_indicator" data-slide-to="14"></li>
	<li data-target="#carousel1_indicator" data-slide-to="15"></li>
	<li data-target="#carousel1_indicator" data-slide-to="16"></li>
	<li data-target="#carousel1_indicator" data-slide-to="17"></li>
	<li data-target="#carousel1_indicator" data-slide-to="18"></li>
	<li data-target="#carousel1_indicator" data-slide-to="19"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('frontend/cssfiles/images/nyati/slider/1.jpg') }}" alt="First slide"> 
	  <div class="carousel-caption d-md-block p-1 bg-primary">
			<h5>Wall Grill</h5>
	  </div>
    </div>
    <div class="carousel-item">
      <img src="{{ asset('frontend/cssfiles/images/nyati/slider/2_edited.jpg') }}" alt="Second slide">
	  <div class="carousel-caption d-md-block p-1 bg-primary">
			<h5>Coloured Cabro</h5>
	  </div>
    </div>
    <div class="carousel-item">
      <img src="{{ asset('frontend/cssfiles/images/nyati/slider/3_edited.jpg') }}" alt="Third slide">
	  <div class="carousel-caption d-md-block p-1 bg-primary">
			<h5>Hollow Blocks</h5>
	  </div>
    </div>
	<div class="carousel-item">
      <img src="{{ asset('frontend/cssfiles/images/nyati/catalogue/woordoor.jpg') }}" alt="Third slide">
	  <div class="carousel-caption d-md-block p-1 bg-primary">
			<h5>Wood Designers</h5>
	  </div>
    </div>
	<div class="carousel-item">
      <img src="{{ asset('frontend/cssfiles/images/nyati/slider/10.jpg') }}" alt="Fourth slide">
	  <div class="carousel-caption d-md-block p-1 bg-primary">
			<h5>Beautiful Pavement</h5>
	  </div>
    </div>
	<div class="carousel-item">
      <img src="{{ asset('frontend/cssfiles/images/nyati/new/mazera.jpg') }}" alt="Fifth slide">
	  <div class="carousel-caption d-md-block p-1 bg-primary">
			<h5>Mazera</h5>
	  </div>
    </div>
	<div class="carousel-item">
      <img src="{{ asset('frontend/cssfiles/images/nyati/catalogue/shallowdrain2.jpg') }}" alt="Sixth slide">
	  <div class="carousel-caption d-md-block p-1 bg-primary">
			<h5>Shallow Drain</h5>
	  </div>
    </div>
	<div class="carousel-item">
      <img src="{{ asset('frontend/cssfiles/images/nyati/slider/11_edited.jpg') }}" alt="seventh slide">
	  <div class="carousel-caption d-md-block p-1 bg-primary">
			<h5>Ventilation</h5>
	  </div>
    </div>
	<div class="carousel-item">
      <img src="{{ asset('frontend/cssfiles/images/nyati/slider/6_edited.jpg') }}" alt="eight slide">
	  <div class="carousel-caption d-md-block p-1 bg-primary">
			<h5>Solid Blocks</h5>
	  </div>
    </div>
	<div class="carousel-item">
      <img src="{{ asset('frontend/cssfiles/images/nyati/catalogue/hollowbricks_edited.jpg') }}" alt="nine slide">
	  <div class="carousel-caption d-md-block p-1 bg-primary">
			<h5>Hollow Blocks</h5>
	  </div>
    </div>
	<div class="carousel-item">
      <img src="{{ asset('frontend/cssfiles/images/nyati/slider/8.jpg') }}" alt="tenth slide">
	  <div class="carousel-caption d-md-block p-1 bg-primary">
			<h5>Footpath within Eldoret CBD</h5>
	  </div>
    </div>
	<div class="carousel-item">
      <img src="{{ asset('frontend/cssfiles/images/nyati/catalogue/custom.jpg') }}" alt="eleventh slide">
	  <div class="carousel-caption d-md-block p-1 bg-primary">
			<h5>Flower Pot</h5>
	  </div>
    </div>
	<div class="carousel-item">
      <img src="{{ asset('frontend/cssfiles/images/nyati/slider/13.jpg') }}" alt="twelvth slide">
	  <div class="carousel-caption d-md-block p-1 bg-primary">
			<h5>Garden Kerb</h5>
	  </div>
    </div>
    <div class="carousel-item">
      <img src="{{ asset('frontend/cssfiles/images/nyati/slider/14.jpg') }}" alt="Thirteenth slide">
	  <div class="carousel-caption d-md-block p-1 bg-primary">
			<h5>Concrete Tiles</h5>
	  </div>
    </div>
	<div class="carousel-item">
      <img src="{{ asset('frontend/cssfiles/images/nyati/slider/15.jpg') }}" alt="Fourteenth slide">
	  <div class="carousel-caption d-md-block p-1 bg-primary">
			<h5>Culvert Rings</h5>
	  </div>
    </div>
	<div class="carousel-item">
      <img src="{{ asset('frontend/cssfiles/images/nyati/slider/16.jpg') }}" alt="Fifteenth slide">
	  <div class="carousel-caption d-md-block p-1 bg-primary">
			<h5>Louvre</h5>
	  </div>
    </div>
	<div class="carousel-item">
      <img src="{{ asset('frontend/cssfiles/images/nyati/slider/17.jpg') }}" alt="Sixteenth slide">
	  <div class="carousel-caption d-md-block p-1 bg-primary">
			<h5>Paving Blocks</h5>
	  </div>
    </div>
	<div class="carousel-item">
      <img src="{{ asset('frontend/cssfiles/images/nyati/slider/18.jpeg') }}" alt="Seventeenth slide">
	  <div class="carousel-caption d-md-block p-1 bg-primary">
			<h5>Road Channel</h5>
	  </div>
    </div>
	<div class="carousel-item">
      <img src="{{ asset('frontend/cssfiles/images/nyati/slider/19.jpg') }}" alt="Eighteenth slide">
	  <div class="carousel-caption d-md-block p-1 bg-primary">
			<h5>Spindle</h5>
	  </div>
    </div>
	<div class="carousel-item">
      <img src="{{ asset('frontend/cssfiles/images/nyati/slider/20.jpg') }}" alt="Nineteenth slide">
	  <div class="carousel-caption d-md-block p-1 bg-primary">
			<h5>Window sill</h5>
	  </div>
    </div>
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

	</div> <!-- col.// -->
	<div class="col-md d-none d-lg-block flex-grow-1">
		<aside class="special-home-right">
			<h6 class="bg-blue text-center text-white mb-0 p-2">Top Interests</h6>

			@forelse($topCats as $cat)
			<div class="card-banner border-bottom">
			  <div class="py-3" style="width:80%">
			    <h6 class="card-title">{{$cat->slug}}</h6>
			    <a href="{{ route('category.show.product', $cat->slug) }}" class="btn btn-secondary btn-sm"> Source now </a>
			  </div> 
			  		@if(empty($cat->image))
			  			<img src="{{ asset('frontend/cssfiles/images/image-not-available.png') }}" height="80" class="img-bg">
					@else
						<img src="{{ asset('storage/'.$cat->image) }}" height="80" class="img-bg">
					@endif
			  <img src="{{ asset('storage/'.$cat->image) }}" height="80" class="img-bg">
			</div>
			@empty
			<div class="alert alert-warning" role="alert">
					Theres no Category.
				</div>
			@endforelse


		</aside>
	</div> <!-- col.// -->
</div> <!-- row.// -->

	</div> <!-- card-body.// -->
</main> <!-- card.// -->

</section>
<!-- ========================= SECTION MAIN END// ========================= -->


<!-- =============== SECTION 2 =============== -->
<section class="padding-bottom">
<header class="section-heading heading-line">
	<h4 class="title-section text-uppercase">Cataloque</h4>
</header>

<div class="card card-home-category">
<div class="row no-gutters">
	<div class="col-md-3">
	
	<div class="home-category-banner bg-light-orange catalogue">
		<h5 class="title">Nyati Supreme Concrete Works</h5>
		<p>Here are but a few of the products we manufacture. We value our customers with services we offer. </p>
		<a href="{{ route('product.information') }}" class="btn btn-outline-primary rounded-pill">See More</a>
		<img src="{{ asset('frontend/cssfiles/images/nyati/catalogue/logo.png') }}" style="" class="img-bg responsive">
	</div>

	</div> <!-- col.// -->
	<div class="col-md-9">
<ul class="row no-gutters bordered-cols">
	<li class="col-6 col-lg-3 col-md-4">
<a href="{{ route('item.show', 'block') }}" class="item"> 
	<div class="card-body catalogueimg">
		<h5 class="title">Solid Blocks </h5>
		<img class="img-sm float-right" src="{{ asset('frontend/cssfiles/images/nyati/catalogue/block1.jpg') }}"> 
		<p class="text-muted">High quality concrete blocks that meet both dimensional and strength</p>
	</div>
</a>
	</li>
	<li class="col-6 col-lg-3 col-md-4">
<a href="{{ route('item.show', 'block') }}" class="item"> 
	<div class="card-body catalogueimg">
		<h5 class="title">Hollow blocks and Hollow Port  </h5>
		<img class="img-sm float-right" src="{{ asset('frontend/cssfiles/images/nyati/catalogue/hollo_edited.jpg') }}"> 
		<p class="text-muted">Both hollow blocks and hollow ports are void fillers hence non-load bearing</p>
	</div>
</a>
	</li>
	<li class="col-6 col-lg-3 col-md-4">
<a href="{{ route('item.show', 'cabro') }}" class="item"> 
	<div class="card-body catalogueimg">
		<h5 class="title">Coloured Cabros  </h5>
		<img class="img-sm float-right" src="{{ asset('frontend/cssfiles/images/nyati/catalogue/cabro2.jpg') }}"> 
		<p class="text-muted">Special type of paving blocks with various profiles and customised colours</p>
	</div>
</a>
	</li>
	<li class="col-6 col-lg-3 col-md-4">
<a href="{{ route('item.show', 'paving-block') }}" class="item"> 
	<div class="card-body catalogueimg">
		<h5 class="title">Paving Blocks  </h5>
		<img class="img-sm float-right" src="{{ asset('frontend/cssfiles/images/nyati/catalogue/paveblock2.jpg') }}"> 
		<p class="text-muted">Void fillers hence non-load bearing</p>
	</div>
</a>	
	</li>
	<li class="col-6 col-lg-3 col-md-4">
<a href="{{ route('item.show', 'wall-copping') }}" class="item"> 
	<div class="card-body catalogueimg">
		<h5 class="title">Wall Coppings  </h5>
		<img class="img-sm float-right" src="{{ asset('frontend/cssfiles/images/nyati/catalogue/wallcopping_edited.jpg') }}"> 
		<p class="text-muted"> Protecting your perimeter walling or outer exposed walling</p>
	</div>
</a>
	</li>
	<li class="col-6 col-lg-3 col-md-4">
<a href="{{ route('item.show', 'baluster-and-spindle') }}" class="item"> 
	<div class="card-body catalogueimg">
		<h5 class="title">Baluster  </h5>
		<img class="img-sm float-right" src="{{ asset('frontend/cssfiles/images/nyati/catalogue/baluster_edited.jpg') }}"> 
		<p class="text-muted"> Used as railings and poles in balconies, verandas and stairways</p>
	</div>
</a>
	</li>
	<li class="col-6 col-lg-3 col-md-4">
<a href="{{ route('item.show', 'louvre-and-ventilation') }}" class="item"> 
	<div class="card-body catalogueimg">
		<h5 class="title">Louvre Block and Ventilation  </h5>
		<img class="img-sm float-right" src="{{ asset('frontend/cssfiles/images/nyati/catalogue/ventilation4.jpg') }}"> 
		<p class="text-muted">Precast louver blocks allow light and air into a functional space</p>

	</div>
</a>
	</li>
	<li class="col-6 col-lg-3 col-md-4">
<a href="{{ route('item.show', 'drains') }}" class="item"> 
	<div class="card-body catalogueimg">
		<h5 class="title">Storm Water Drain  </h5>
		<img class="img-sm float-right" src="{{ asset('frontend/cssfiles/images/nyati/catalogue/shallowdrain1.jpg') }}"> 
		<p class="text-muted">Helps direct large flow of water safely avoiding </p>
	</div>
</a>
	</li>
</ul>
	</div> <!-- col.// -->
</div> <!-- row.// -->
</div> <!-- card.// -->
</section>
<!-- =============== SECTION 2 END =============== -->

<section class="section-content padding-y bg">
<div class="container">
<div class="row">
		<div class="col-md-4">
<!-- ============================ COMPONENT BANNER 1 ================================= -->
<div class="card-banner" style="height:220px; background-image: url('{{ asset('frontend/cssfiles/images/nyati/catalogue/roadkerb3_edited.jpg') }}');">
  <article class="card-body caption">
	<h5 class="card-title">Road Kerb and Channel</h5>
	<p>high quality concrete blocks that meet both dimensional and strength requirements by the
relevant authorities and according to customer specifications.
.</p>
	<a href="{{ route('item.show', 'road-kerb') }}" class="btn btn-warning">Shop Item</a>
  </article>
</div>
<!-- ======================= COMPONENT BANNER 1  END .// ============================ -->
		</div> <!-- col.// -->
		<div class="col-md-4">
<!-- ============================ COMPONENT BANNER 2 ================================= -->
<div class="card-banner" style="height:220px; background-image: url('{{ asset('frontend/cssfiles/images/nyati/catalogue/culvert2.jpg') }}');">
  <article class="card-body  text-white">
	<h5 class="card-title">Culvert</h5>
	<p>high quality culvert used to convey water from one area to another, normally from one side of a road to the other side.</p>
	<a href="{{ route('item.show', 'culvert') }}" class="btn btn-warning">Shop Item</a>
  </article>
</div>
<!-- ============================ COMPONENT BANNER 2  END .// =========================== -->
		</div> <!-- col.// -->
		<div class="col-md-4">
<!-- ============================ COMPONENT BANNER 3 ================================= -->
<div class="card-banner" style="height:220px; background-image: url('{{ asset('frontend/cssfiles/images/nyati/catalogue/paveslabs_edited.jpg') }}');">
  <article class="card-img-overlay bg-gradient-red text-white">
	<h5 class="card-title">Slabs</h5>
	<p>Concrete or stone slabs use to beautify and mark the pavements clearly.</p>
	<a href="{{ route('item.show', 'paving-slab') }}" class="btn btn-warning">Shop Item</a>
  </article>
</div>
<!-- ============================ COMPONENT BANNER 3  END .// ================================= -->
		</div> <!-- col.// -->
</div> <!-- row.// -->
</div> <!-- container .//  -->
</section>

<!-- =============== SECTION REQUEST =============== -->

<section class="padding-bottom">

<header class="section-heading heading-line">
	<h4 class="title-section">Request for Item</h4>
</header>

<div class="row">

                <div class="col-sm-12">
                    @if (Session::has('message'))
                        <p class="alert alert-success">{{ Session::get('message') }}</p>
                    @endif
                </div>
				
	<div class="col-md-8">
<div class="card-banner banner-quote overlay-gradient" style="background-image: url('frontend/cssfiles/images/nyati/catalogue/options_edited.jpg');">
  <div class="card-img-overlay white">
    <h3 class="card-title">Not finding what you are looking for?</h3>
    <p class="card-text" style="max-width: 400px">Do not you worry if you cannot find the product specification youtr looking for. 
	Just fill in the form with your specifications and we shall get back to you shortly after.</p>
    <a href="{{route('unavailableitems')}}" class="btn btn-primary rounded-pill">Learn more</a>
  </div>
</div>
	</div> <!-- col // -->
	<div class="col-md-4">

<div class="card card-body">
	<h5 class="title">Please fill in the form with your needs</h5>
	<form method="post" action="{{ route('admin.requestproducts.store')}}" role="form">
		@csrf
		<div class="form-group">
			<input class="form-control" name="name" placeholder="What are you looking for?" type="text" required>
		</div>
		<div class="form-group">
			<div class="input-group">
				<input class="form-control" placeholder="Quantity" name="quantity" type="text" required>
				<input class="form-control" placeholder="Email or Number" name="email_number" type="text" required>
			</div>
		</div>
		<div class="form-group text-muted">
		<p>Description:</p>
		<textarea id="w3review" name="description" rows="2" class="form-control" cols="42">
		</textarea>
		</div>
		<div class="form-group">
			<button class="btn btn-warning" type="submit" >Send Request</button>
		</div>
	</form>
</div>

	</div> <!-- col // -->
</div> <!-- row // -->
</section>

<!-- =============== SECTION REQUEST .//END =============== -->


<!-- =============== SECTION ITEMS =============== -->
<section  class="padding-bottom-sm">

<header class="section-heading heading-line">
	<h4 class="title-section text-uppercase">Top Items</h4>
</header>

<div class="row row-sm">
@forelse($topItems as $item)
	<div class="col-xl-2 col-lg-3 col-md-4 col-6">
		<div class="card card-sm card-product-grid">
					@if(empty($item->images->first()->full))
						<a href="{{ route('product.show', $item->slug) }}" data-fancybox data-caption="{{ asset('frontend/cssfiles/images/image-not-available.png') }}" class="img-wrap"><img src=""></a>
					@else
						<a href="{{ route('product.show', $item->slug) }}" class="img-wrap"> <img src="{{ asset('storage/'.$item->images->first()->full )}}"> </a>
					@endif
			<figcaption class="info-wrap">
				<a href="#" class="title">{{$item->name}}</a>
				<div class="price mt-1">{{ config('settings.currency_symbol') }} {{ $item->price }}</div> <!-- price-wrap.// -->
			</figcaption>
		</div>
	</div> <!-- col.// -->
	@empty
			<div class="alert alert-warning" role="alert">
					Theres no More Products.
				</div>
			@endforelse
</div> <!-- row.// -->
<a href="{{ route('shop') }}" class="btn btn-warning">See More</a>
</section>
<!-- =============== SECTION ITEMS .//END =============== -->

<!-- =============== SECTION BANNER =============== -->
<section class="padding-bottom bannersection">
	<div class="row">
		<aside class="col-md-6">
			<div class="card card-banner-lg bg-dark">
				<img src="{{ asset('frontend/cssfiles/images/nyati/catalogue/woordoor.jpg') }}" class="card-img opacity">
				<div class="card-img-overlay text-white">
				  <h3 class="card-title">Wood Designers</h3>
				  <!-- <p class="card-text" style="max-width: 100%;">High quality concrete blocks that meet both dimensional and strength requirements by the
relevant authorities and customer specifications.</p> -->
					<!-- <a href="{{ route('item.show', 'block') }}" class="btn btn-warning">View more</a> -->
				</div>
			 </div>
		</aside>
		<div class="col-md-6">
			<div class="card card-banner-lg bg-dark">
				<img src="{{ asset('frontend/cssfiles/images/nyati/catalogue/cabro3.jpg') }}" class="card-img opacity">
				<div class="card-img-overlay text-white">
				  <h3 class="card-title">Beautifuly Coloured Cabro</h3>
				    <p class="card-text" style="max-width: 100%">We offer special type of paving blocks with various profiles and customised colours according to client needs,
this provides a break from the monotony of the common profiles and ordinary grey/whitish shade.</p>
					<a href="{{ route('item.show', 'cabro') }}" class="btn btn-warning">View more</a>
				</div>
			 </div>
		</div> <!-- col.// -->
	</div> <!-- row.// -->
</section>
<!-- =============== SECTION BANNER .//END =============== -->


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


</div>  
<!-- container end.// -->

@stop