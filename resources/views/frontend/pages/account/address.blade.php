@extends('frontend.app')
@section('content')
    <!-- ========================= SECTION PAGETOP ========================= -->
<section class="section-pagetop bg-gray">
<div class="container">
	<h2 class="title-page">My account</h2>
</div> <!-- container //  -->
</section>
<!-- ========================= SECTION PAGETOP END// ========================= -->


<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y">
	<div class="container">
	
	<div class="row">
		<aside class="col-md-3">
        @include('frontend.pages.account.nav.nav')
		</aside> <!-- col.// -->
		<main class="col-md-9">

        @if (isset($success))
            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                $success
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            </div>
        @endif

        <a href="{{ route('account.address.create') }}" class="btn btn-light mb-3"> <i class="fa fa-plus"></i> Add new address </a>
        <a href="{{ route('account.address.clear') }}" class="btn btn-light mb-3"> <i class="fa fa-minus"></i> Disable address </a>

        <div class="row">

        @foreach ($addresss as $key => $address)

            <div class="col-md-6">
                <article class="box mb-4">
                    <h5>{{$address->city}}</h5>
                    <h6>{{$address->town}}, {{$address->county}}</h6>
                    <p>{{$address->address}} <br> Floor: 22, Aprt: 12  </p>
                    
                    @if ($address->default_address)
                    <a href="" class="btn btn-success disabled"> <i class="fa fa-check"></i> Main Shipping Address</a>
                    @else
                    <a href="{{ route('account.address.default',['id' => $address->id]) }}" class="btn btn-light">Make Main Address</a>
                    @endif

                    <a href="{{ route('account.address.edit',['id' => $address->id]) }}" class="btn btn-light"> <i class="fa fa-pen"></i> </a>   <a href="{{ route('account.address.delete',['id' => $address->id]) }}" class="btn btn-light"> <i class="text-danger fa fa-trash"></i>  </a>
                </article>
            </div>  <!-- col.// -->

            @endforeach

        </div> <!-- row.// -->

	</main> <!-- col.// -->
</div>

</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
@stop
