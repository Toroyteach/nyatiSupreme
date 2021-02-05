@extends('frontend.app')
@section('content')

<!-- ========================= SECTION PAGETOP ========================= -->
<section class="section-pagetop bg">
<div class="container">
	<h2 class="title-page">Services</h2>
	<nav>
	<ol class="breadcrumb text-white">
	    <li class="breadcrumb-item"><a href="#">Home</a></li>
	    <li class="breadcrumb-item"><a href="#">Category</a></li>
	    <li class="breadcrumb-item active" aria-current="page">Product</li>
	</ol>  
	</nav>
</div> <!-- container //  -->
</section>
<!-- ========================= SECTION INTRO END// ========================= -->

<!-- =============== SECTION SERVICES .//END =============== -->

      <!-- Marketing messaging and featurettes
      ================================================== -->
      <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <p class="lead">One of the key reasons for our longevity and continual development as a company

		is our commitment to quality and ensuring that the customers’ needs are at the fore-
		front of everything we do.

		This entrenched philosophy encompasses all our operations from selecting only the
		best raw materials available to our products to manufacturing our products in strict
		adherence to BS 5628, Eurocode among other Industry regulations.
		</p>
        <!-- START THE FEATURETTES -->

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7">
            <h4 class="featurette-heading">Team work. <span class="text-muted">All the way.</span></h4>
            <p class="lead">It will please our clients to know that we have
              acquired a reputation of making high quality products
              and this can be attributed to the selection of the best raw
              materials.</p>
          </div>
          <div class="col-md-5">
            <img class="featurette-image img-fluid mx-auto" style="height: 200px;" src="{{ asset('frontend/cssfiles/images/nyati/catalogue/options_edited.jpg') }}" alt="Generic placeholder image">
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7 order-md-2">
            <h4 class="featurette-heading">High quality output. <span class="text-muted">With product inspection.</span></h4>
            <p class="lead">Through our “client is king” philosophy we have ensured to
                train our staff on customer care and interaction hence the
                excellent experience that they always experience.</p>
          </div>
          <div class="col-md-5 order-md-1">
            <img class="featurette-image img-fluid mx-auto" style="height: 200px;"  src="{{ asset('frontend/cssfiles/images/nyati/slider/3_edited.jpg') }}" alt="Generic placeholder image">
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7">
            <h4 class="featurette-heading">Customer. <span class="text-muted"> Reachability.</span></h4>
            <p class="lead">Our group of two manufacturing plants are located within Eldoret town
							offering a comprehensive and flexible supply network both of which are
							well established and highly respected.</p>
          </div>
          <div class="col-md-5">
            <img class="featurette-image img-fluid mx-auto" style="height: 200px;" src="{{ asset('frontend/cssfiles/images/nyati/catalogue/work_edited.jpg') }}" alt="Generic placeholder image">
          </div>
        </div>

        <hr class="featurette-divider">

        <!-- /END THE FEATURETTES -->

      </div><!-- /.container -->
  </div> <!-- row.// -->

@stop