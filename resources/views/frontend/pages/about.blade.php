@extends('frontend.app')
@section('content')

<!-- =============== SECTION SERVICES =============== -->
<section  class="padding-bottom padding-top">

<header class="section-heading heading-line">
    <h4 class="title-section text-uppercase">We pride ourselves with this qualities</h4>
    <p class="text-muted"></p>
</header>

</section>
<!-- =============== SECTION SERVICES .//END =============== -->

      <!-- Marketing messaging and featurettes
      ================================================== -->
      <!-- Wrap the rest of the page in another container to center all the content. -->

      <div class="container marketing">


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
            <h4 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h4>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
          </div>
          <div class="col-md-5">
            <img class="featurette-image img-fluid mx-auto" style="height: 200px;" src="{{ asset('frontend/cssfiles/images/nyati/catalogue/work_edited.jpg') }}" alt="Generic placeholder image">
          </div>
        </div>

        <hr class="featurette-divider">

        <!-- /END THE FEATURETTES -->

      </div><!-- /.container -->

    </main>

    <div class="row">
	<div class="col-md-3 col-sm-6">
		<article class="card card-post">
		  <img src="{{ asset('frontend/cssfiles/images/posts/1.jpg') }}" class="card-img-top">
		  <div class="card-body">
		    <h6 class="title">Trade Assurance</h6>
		    <p class="small text-uppercase text-muted">Order protection</p>
		  </div>
		</article> <!-- card.// -->
	</div> <!-- col.// -->
	<div class="col-md-3 col-sm-6">
		<article class="card card-post">
		  <img src="{{ asset('frontend/cssfiles/images/posts/2.jpg') }}" class="card-img-top">
		  <div class="card-body">
		    <h6 class="title">Easy Payment</h6>
		    <p class="small text-uppercase text-muted">Finance solution</p>
		  </div>
		</article> <!-- card.// -->
	</div> <!-- col.// -->
	<div class="col-md-3 col-sm-6">
		<article class="card card-post">
		  <img src="{{ asset('frontend/cssfiles/images/posts/3.jpg') }}" class="card-img-top">
		  <div class="card-body">
		    <h6 class="title">Inspection solution</h6>
		    <p class="small text-uppercase text-muted">Easy Inspection</p>
		  </div>
		</article> <!-- card.// -->
	</div> <!-- col.// -->
	<div class="col-md-3 col-sm-6">
		<article class="card card-post">
		  <img src="{{ asset('frontend/cssfiles/images/posts/4.jpg') }}" class="card-img-top">
		  <div class="card-body">
		    <h6 class="title">Safe and Fast Shipping</h6>
		    <p class="small text-uppercase text-muted">Logistic services</p>
		  </div>
		</article> <!-- card.// -->
	</div> <!-- col.// -->
</div> <!-- row.// -->


@stop