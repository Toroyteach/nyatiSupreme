@extends('frontend.app')
@section('content')
    <!-- ========================= SECTION CONTENT ========================= -->
	<section class="section-pagetop bg">
<div class="container">
	<h2 class="title-page"> Products</h2>
	<nav>
	{{ Breadcrumbs::render('category') }}
	</nav>
</div> <!-- container //  -->
</section>

<!-- ========================= SECTION CONTENT END// ========================= -->

<br><br>


<div class="row">
		<div class="col-md-4">
<!-- ============================ COMPONENT BANNER 4 ================================= -->
        <div class="card-banner" style="height:250px; background-image: url('{{ asset('frontend/cssfiles/images/nyati/catalogue/paveslabs_edited.jpg') }}');">
			  <article class="caption bottom">
			    	<h5 class="card-title">Side Slabs</h5>
                    <p>Used to mark beautify walking or pavement slabs.</p>
                    <a href="{{ route('item.show', 'ventilation') }}" class="btn btn-light">Shop Item</a>
			   </article>
			</div>
<!-- ======================= COMPONENT BANNER 4  END .// ============================ -->
		</div> <!-- col.// -->
		<div class="col-md-4">
<!-- ============================ COMPONENT BANNER 5  ================================= -->
			<div class="card-banner" style="height:250px; background-image: url('{{ asset('frontend/cssfiles/images/nyati/catalogue/road_kerbs.jpg') }}');">
			  <article class="caption bottom">
			    	<h5 class="card-title">Road Kerbs</h5>
                    <p>Lateral support, protects edges Indicates boundary.</p>
                    <a href="{{ route('item.show', 'ventilation') }}" class="btn btn-light">Shop Item</a>
			   </article>
			</div>
<!-- ============================ COMPONENT BANNER 5  END .// =========================== -->
		</div> <!-- col.// -->
		<div class="col-md-4">
<!-- ============================ COMPONENT BANNER 6 ================================= -->
        <div class="card-banner" style="height:250px; background-image: url('{{ asset('frontend/cssfiles/images/nyati/catalogue/fence2.jpg') }}');">
			  <article class="caption bottom">
			    	<h5 class="card-title">Fencing poles</h5>
                    <p>Beautiful fencing poles to complement and enhance security in your location.</p>
                    <a href="{{ route('item.show', 'ventilation') }}" class="btn btn-light">Shop Item</a>
			   </article>
			</div>
<!-- ============================ COMPONENT BANNER 6  END .// ================================= -->
		</div> <!-- col.// -->
</div> <!-- row.// -->

<br><br>


<div class="row">
		<div class="col-md-4">
<!-- ============================ COMPONENT BANNER 4 ================================= -->
        <div class="card-banner" style="height:250px; background-image: url('{{ asset('frontend/cssfiles/images/nyati/catalogue/51_edited.jpg') }}');">
			  <article class="caption bottom">
			    	<h5 class="card-title">Custom Products</h5>
                    <p>Precast louver blocks allow light and air into a functional space whilst proving beauty.</p>
                    <a href="{{ route('item.show', 'ventilation') }}" class="btn btn-light">Shop Item</a>
			   </article>
			</div>
<!-- ======================= COMPONENT BANNER 4  END .// ============================ -->
		</div> <!-- col.// -->
		<div class="col-md-4">
<!-- ============================ COMPONENT BANNER 5  ================================= -->
			<div class="card-banner" style="height:250px; background-image: url('{{ asset('frontend/cssfiles/images/nyati/catalogue/baluster_edited.jpg') }}');">
			  <article class="caption bottom">
			    	<h5 class="card-title">Baluster</h5>
                    <p>Balusters are used as railings and poles in balconies, verandas and stairways for protection.</p>
                    <a href="{{ route('item.show', 'ventilation') }}" class="btn btn-light">Shop Item</a>
			   </article>
			</div>
<!-- ============================ COMPONENT BANNER 5  END .// =========================== -->
		</div> <!-- col.// -->
		<div class="col-md-4">
<!-- ============================ COMPONENT BANNER 6 ================================= -->
        <div class="card-banner" style="height:250px; background-image: url('{{ asset('frontend/cssfiles/images/nyati/catalogue/wallgrillz2.jpg') }}');">
			  <article class="caption bottom">
			    	<h5 class="card-title">Wall Grill</h5>
                    <p>Precast louver blocks allow light and air into a functional space whilst proving beauty</p>
                    <a href="{{ route('item.show', 'ventilation') }}" class="btn btn-light">Shop Item</a>
			   </article>
			</div>
<!-- ============================ COMPONENT BANNER 6  END .// ================================= -->
		</div> <!-- col.// -->
</div> <!-- row.// -->

<br><br>

<!-- ========================= SECTION SUBSCRIBE  ========================= -->
<section class="padding-y-lg bg-light border-top">
<div class="container">

<p class="pb-2 text-center">Delivering the latest product trends and industry news straight to your inbox</p>

<div class="row justify-content-md-center">
	<div class="col-lg-4 col-sm-6">
	<form class="form-row" action="{{ route('subscribers.store') }}" method="post">
	@csrf
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