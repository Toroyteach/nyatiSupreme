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

<section class="section-content padding-y">
<div class="container">
<h4>heading</h4>

<div class="row">
	<aside class="col-md-6">
		<h4>Slick slider banner</h4>
		<!-- ============== COMPONENT SLIDER SINGLE SLICK  ============= -->
		<div class="slider-banner-slick">
			<div class="item-slide">
				<img src="images/banners/slide1.jpg">
			</div>
			<div class="item-slide">
				<img src="images/banners/slide2.jpg">
			</div>
			<div class="item-slide">
				<img src="images/banners/slide3.jpg">
			</div>
		</div>
		<!-- ============== COMPONENT SLIDER SINGLE SLICK .end // ============= -->
		<br><br>
		</aside> <!-- col.// -->
</div>

</div> <!-- container .//  -->
</section>


@stop
@push('scrips')
<script type="text/javascript">
/// some script

// jquery ready start
$(document).ready(function() {
	// jQuery code




    /////////////////  items slider. /plugins/slickslider/
    if ($('.slider-banner-slick').length > 0) { // check if element exists
        $('.slider-banner-slick').slick({
              infinite: true,
              autoplay: true,
              slidesToShow: 1,
              dots: false,
              prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-chevron-left"></i></button>',
           	  nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>',
        });
    } // end if

     /////////////////  items slider. /plugins/slickslider/
    if ($('.slider-custom-slick').length > 0) { // check if element exists
        $('.slider-custom-slick').slick({
              infinite: true,
              slidesToShow: 2,
              dots: true,
              prevArrow: $('.slick-prev-custom'),
              nextArrow: $('.slick-next-custom')
        });
    } // end if

  

    /////////////////  items slider. /plugins/slickslider/
    if ($('.slider-items-slick').length > 0) { // check if element exists
        $('.slider-items-slick').slick({
            infinite: true,
            swipeToSlide: true,
            slidesToShow: 4,
            dots: true,
            slidesToScroll: 2,
            prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-chevron-left"></i></button>',
           	nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>',
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 640,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    } // end if

    

    /////////////////  items slider. /plugins/owlcarousel/
    if ($('.slider-banner-owl').length > 0) { // check if element exists
        $('.slider-banner-owl').owlCarousel({
            loop:true,
            margin:0,
            items: 1,
            dots: false,
            nav:true,
            navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
        });
    } // end if 

    /////////////////  items slider. /plugins/owlslider/
    if ($('.slider-items-owl').length > 0) { // check if element exists
        $('.slider-items-owl').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
            responsive:{
                0:{
                    items:1
                },
                640:{
                    items:3
                },
                1024:{
                    items:4
                }
            }
        })
    } // end if

    /////////////////  items slider. /plugins/owlcarousel/
    if ($('.slider-custom-owl').length > 0) { // check if element exists
        var slider_custom_owl = $('.slider-custom-owl');
        slider_custom_owl.owlCarousel({
            loop: true,
            margin:15,
            items: 2,
            nav: false,
        });

        // for custom navigation
        $('.owl-prev-custom').click(function(){
            slider_custom_owl.trigger('prev.owl.carousel');
        });

        $('.owl-next-custom').click(function(){
           slider_custom_owl.trigger('next.owl.carousel');
        });

    } // end if 



}); 
// jquery end
</script>
@endpush