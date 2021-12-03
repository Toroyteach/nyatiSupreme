@extends('frontend.app')
@section('content')

<!-- =============== SECTION SERVICES =============== -->
<!-- =============== SECTION SERVICES .//END =============== -->

      <!-- Marketing messaging and featurettes
      ================================================== -->
      <!-- Wrap the rest of the page in another container to center all the content. -->

      <div class="container marketing">

      <header class="section-heading heading-line">
        <h4 class="title-section text-uppercase">We pride ourselves with this qualities</h4>
        <p class="text-muted"></p>
    </header>

      <p class="lead">We produce a wide range of masonry building and paving blocks compli-
ant to all the latest technical and environmental standards for use in

foundation walls, Internal walls ,acoustic separating walls ,thermally insu-
lating walls and permeable/semi-permeable paving solutions for drive-
ways , parking bays and fuel stations. We continually strive to enhance

our product range through active research and development (R&D) into
new innovative products that will drive down the cost of construction
through improved manufacturing processes and the increased use of
recycled materials in our manufacturing processes with a commitment to
minimize our impact on the environment by reducing energy use
throughout our operations whilst continuing to produce high quality
products for the low carbon homes of the future..</p>
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

  <!-- =============== SECTION SERVICES =============== -->
<!-- <section  class="padding-bottom padding-top">

<header class="section-heading heading-line">
    <h5 class="title-section">Quality, Environmental and Sustainability</h5>
    <p class="text-muted"></p>
</header>

</section> -->
<!-- =============== SECTION SERVICES .//END =============== -->

      <!-- Marketing messaging and featurettes
      ================================================== -->
      <!-- Wrap the rest of the page in another container to center all the content. -->

      <div class="container marketing">

      <header class="section-heading heading-line">
        <h5 class="title-section">Quality, Environmental and Sustainability</h5>
        <p class="text-muted"></p>
    </header>

      <p class="lead">Our belief is that true business success is achieved through giving the customer the
highest quality products going hand in hand with excellent customer service which
is the reason why we have continually grown as a business whilst achieving 100%
customer retention and innumerable referrals since our inception.
We are fully committed to ensuring we minimize our impact upon the environment
and to promote the undoubted and proven 3 sustainability principles of Masonry
construction</p>

<ul class="list-check">
<li>Highest quality products using locally sourced raw materials</li>
<li>Supporting local economies and Jobs</li>
<li>No imported materials and minimal carbon footprint.</li>

</ul>
      </div>
      <br><br>

      <div class="container marketing">
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
              <h6 class="title">Easy Payment Options</h6>
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
              <h6 class="title">Safe and Fast Transportation</h6>
              <p class="small text-uppercase text-muted">Logistic services</p>
            </div>
          </article> <!-- card.// -->
        </div> <!-- col.// -->
      </div>
  </div> <!-- row.// -->


@stop