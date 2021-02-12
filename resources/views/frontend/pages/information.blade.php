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

<br>


<div class="row">
		<div class="col-md-4 col-sm-6 col-lg-4 col-xs-12">
<!-- ============================ COMPONENT BANNER 4 ================================= -->
        <div class="card-banner" style="height:250px; background-image: url('{{ asset('frontend/cssfiles/images/nyati/catalogue/paveslabs_edited.jpg') }}');">
			  <article class="caption bottom">
			    	<h5 class="card-title">Side Slabs</h5>
                    <p>Used to mark beautify walking or pavement slabs.</p>
                    <a href="{{ route('item.show', 'paving-slab') }}" class="btn btn-light">View Item</a>
			   </article>
			</div>
<!-- ======================= COMPONENT BANNER 4  END .// ============================ -->
<br>
		</div> <!-- col.// -->
		<div class="col-md-4 col-sm-6 col-lg-4 col-xs-12">
<!-- ============================ COMPONENT BANNER 5  ================================= -->
			<div class="card-banner" style="height:250px; background-image: url('{{ asset('frontend/cssfiles/images/nyati/catalogue/road_kerbs.jpg') }}');">
			  <article class="caption bottom">
			    	<h5 class="card-title">Road Kerbs</h5>
                    <p>Lateral support, protects edges Indicates boundary.</p>
                    <a href="{{ route('item.show', 'road-kerb') }}" class="btn btn-light">View Item</a>
			   </article>
			</div>
<!-- ============================ COMPONENT BANNER 5  END .// =========================== -->
<br>
		</div> <!-- col.// -->
		<div class="col-md-4 col-sm-6 col-lg-4 col-xs-12">
<!-- ============================ COMPONENT BANNER 6 ================================= -->
        <div class="card-banner" style="height:250px; background-image: url('{{ asset('frontend/cssfiles/images/nyati/catalogue/fence2.jpg') }}');">
			  <article class="caption bottom">
			    	<h5 class="card-title">Fencing poles</h5>
                    <p>Beautiful fencing poles to complement and enhance security in your location.</p>
                    <a href="{{ route('item.show', 'fencing-pole') }}" class="btn btn-light">View Item</a>
			   </article>
			</div>
<!-- ============================ COMPONENT BANNER 6  END .// ================================= -->
		</div> <!-- col.// -->
</div> <!-- row.// -->

<br>


<div class="row">
		<div class="col-md-4 col-sm-6 col-lg-4 col-xs-12">
<!-- ============================ COMPONENT BANNER 4 ================================= -->
        <div class="card-banner" style="height:250px; background-image: url('{{ asset('frontend/cssfiles/images/nyati/catalogue/51_edited.jpg') }}');">
			  <article class="caption bottom">
			    	<h5 class="card-title">Custom Products</h5>
                    <p>Precast louver blocks allow light and air into a functional space whilst proving beauty.</p>
                    <a href="{{ route('item.show', 'complementary-products') }}" class="btn btn-light">View Item</a>
			   </article>
			</div>
<!-- ======================= COMPONENT BANNER 4  END .// ============================ -->
<br>
		</div> <!-- col.// -->
		<div class="col-md-4 col-sm-6 col-lg-4 col-xs-12">
<!-- ============================ COMPONENT BANNER 5  ================================= -->
			<div class="card-banner" style="height:250px; background-image: url('{{ asset('frontend/cssfiles/images/nyati/catalogue/baluster_edited.jpg') }}');">
			  <article class="caption bottom">
			    	<h5 class="card-title">Baluster</h5>
                    <p>Balusters are used as railings and poles in balconies, verandas and stairways for protection.</p>
                    <a href="{{ route('item.show', 'baluster-and-spindle') }}" class="btn btn-light">View Item</a>
			   </article>
			</div>
<!-- ============================ COMPONENT BANNER 5  END .// =========================== -->
<br>
		</div> <!-- col.// -->
		<div class="col-md-4 col-sm-6 col-lg-4 col-xs-12">
<!-- ============================ COMPONENT BANNER 6 ================================= -->
        <div class="card-banner" style="height:250px; background-image: url('{{ asset('frontend/cssfiles/images/nyati/new/arificialmazera.jpg') }}');">
			  <article class="caption bottom">
			    	<h5 class="card-title">Artificial Mazera</h5>
                    <p>Precast louver blocks allow light and air into a functional space whilst proving beauty</p>
                    <a href="{{ route('item.show', 'decorative-products') }}" class="btn btn-light">View Item</a>
			   </article>
			</div>
<!-- ============================ COMPONENT BANNER 6  END .// ================================= -->
		</div> <!-- col.// -->
</div> <!-- row.// -->

<br>

<div class="row">
		<div class="col-md-4 col-sm-6 col-lg-4 col-xs-12">
<!-- ============================ COMPONENT BANNER 4 ================================= -->
        <div class="card-banner" style="height:250px; background-image: url('{{ asset('frontend/cssfiles/images/nyati/new/chimney.jpg') }}');">
			  <article class="caption bottom">
			    	<h5 class="card-title">Chimney Cover</h5>
                    <p>Precast louver blocks allow light and air into a functional space whilst proving beauty.</p>
                    <a href="{{ route('item.show', 'complementary-products') }}" class="btn btn-light">View Item</a>
			   </article>
			</div>
<!-- ======================= COMPONENT BANNER 4  END .// ============================ -->
<br>
		</div> <!-- col.// -->
		<div class="col-md-4 col-sm-6 col-lg-4 col-xs-12">
<!-- ============================ COMPONENT BANNER 5  ================================= -->
			<div class="card-banner" style="height:250px; background-image: url('{{ asset('frontend/cssfiles/images/nyati/catalogue/baluster_edited.jpg') }}');">
			  <article class="caption bottom">
			    	<h5 class="card-title">Wall cladding</h5>
                    <p>Balusters are used as railings and poles in balconies, verandas and stairways for protection.</p>
                    <a href="{{ route('item.show', 'complementary-products') }}" class="btn btn-light">View Item</a>
			   </article>
			</div>
<!-- ============================ COMPONENT BANNER 5  END .// =========================== -->
<br>
		</div> <!-- col.// -->
		<div class="col-md-4 col-sm-6 col-lg-4 col-xs-12">
<!-- ============================ COMPONENT BANNER 6 ================================= -->
        <div class="card-banner" style="height:250px; background-image: url('{{ asset('frontend/cssfiles/images/nyati/catalogue/custom.jpg') }}');">
			  <article class="caption bottom">
			    	<h5 class="card-title">Flower Pots</h5>
                    <p>Precast louver blocks allow light and air into a functional space whilst proving beauty</p>
                    <a href="{{ route('item.show', 'complementary-products') }}" class="btn btn-light">View Item</a>
			   </article>
			</div>
<!-- ============================ COMPONENT BANNER 6  END .// ================================= -->
		</div> <!-- col.// -->
</div> <!-- row.// -->

<br>

<div class="row">
		<div class="col-md-4 col-sm-6 col-lg-4 col-xs-12">
<!-- ============================ COMPONENT BANNER 4 ================================= -->
        <div class="card-banner" style="height:250px; background-image: url('{{ asset('frontend/cssfiles/images/nyati/catalogue/paveslab.jpg') }}');">
			  <article class="caption bottom">
			    	<h5 class="card-title">Concrete Tile</h5>
                    <p>Precast louver blocks allow light and air into a functional space whilst proving beauty.</p>
                    <a href="{{ route('item.show', 'complementary-products') }}" class="btn btn-light">View Item</a>
			   </article>
			</div>
<!-- ======================= COMPONENT BANNER 4  END .// ============================ -->
<br>
		</div> <!-- col.// -->
		<div class="col-md-4 col-sm-6 col-lg-4 col-xs-12">
<!-- ============================ COMPONENT BANNER 5  ================================= -->
			<div class="card-banner" style="height:250px; background-image: url('{{ asset('frontend/cssfiles/images/nyati/new/gardenkerb.jpg') }}');">
			  <article class="caption bottom">
			    	<h5 class="card-title">Garden Kerb</h5>
                    <p>Balusters are used as railings and poles in balconies, verandas and stairways for protection.</p>
                    <a href="{{ route('item.show', 'complementary-products') }}" class="btn btn-light">View Item</a>
			   </article>
			</div>
<!-- ============================ COMPONENT BANNER 5  END .// =========================== -->
<br>
		</div> <!-- col.// -->
		<div class="col-md-4 col-sm-6 col-lg-4 col-xs-12">
<!-- ============================ COMPONENT BANNER 6 ================================= -->
        <div class="card-banner" style="height:250px; background-image: url('{{ asset('frontend/cssfiles/images/nyati/new/pillacap.jpg') }}');">
			  <article class="caption bottom">
			    	<h5 class="card-title">Pillar Cap</h5>
                    <p>Precast louver blocks allow light and air into a functional space whilst proving beauty</p>
                    <a href="{{ route('item.show', 'complementary-products') }}" class="btn btn-light">View Item</a>
			   </article>
			</div>
<!-- ============================ COMPONENT BANNER 6  END .// ================================= -->
		</div> <!-- col.// -->
</div> <!-- row.// -->

<br>

@stop