@extends('frontend.app')
@section('content')
<section class="py-3 bg-light">
  <div class="container">
  <div class="row">
                <div class="col-sm-12">
                    @if (Session::has('message'))
                        <p class="alert alert-success">{{ Session::get('message') }}</p>
                    @endif
                </div>
            </div>
    <ol class="breadcrumb">
      {{ Breadcrumbs::render('category') }}
    </ol>
  </div>
</section>

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content bg-white padding-y">
<div class="container">

<!-- ============================ ITEM DETAIL ======================== -->
	<div class="row">
		<aside class="col-md-6">
			<div class="card">

			<article class="gallery-wrap"> 
												@if ($product->images->count() > 0)
													<div class="img-big-wrap">
														<div class="">
															<a href="{{ asset('storage/'.$product->images->first()->full) }}" data-fancybox data-caption="{{$product->name}}">
																<img src="{{ asset('storage/'.$product->images->first()->full) }}" alt="" class="img-fluid" >
															</a>
														</div>
													</div>
												@else
													<div class="img-big-wrap">
														<div>
															<a href="https://via.placeholder.com/176" data-fancybox=""><img src="https://via.placeholder.com/176"></a>
														</div>
													</div>
												@endif
												@if ($product->images->count() > 0)
													<div class="img-small-wrap">
														@foreach($product->images as $image)
															<div class="">
																<img src="{{ asset('storage/'.$image->full) }}" alt="" class="img-fluid">
															</div>
														@endforeach
													</div>
												@endif
			</article> <!-- gallery-wrap .end// -->

			</div> <!-- card.// -->
		</aside>
		<main class="col-md-6">
<article class="product-info-aside">

<h2 class="title mt-3">{{ $product->name }}</h2>

<div class="rating-wrap my-3">
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
	<small class="label-rating text-muted">132 reviews</small>
	<small class="label-rating text-success"> <i class="fa fa-clipboard-check"></i> 154 orders </small>
</div> <!-- rating-wrap.// -->

<div class="mb-3"> 

										@if ($product->sale_price > 0)
                                            <var class="price h3 text-danger">
                                                <span class="price h4">{{ config('settings.currency_symbol') }}</span><span class="num" id="productPrice">{{ $product->sale_price }}</span>
                                                <del class="text-muted"> {{ config('settings.currency_symbol') }} {{ $product->price }}</del>
                                            </var>
                                        @else
                                            <var class="price h3 text-info">
                                                <span class="price h4">{{ config('settings.currency_symbol') }}</span><span class="num" id="productPrice"> {{ $product->price }}</span>
                                            </var>
                                        @endif
</div> <!-- price-detail-wrap .// -->

<form action="{{ route('product.add.cart') }}" method="POST" role="form" id="addToCart">
    @csrf
	<div class="form-row  mt-4">

		<div class="form-group col-md-12">
	
											<div class="col-sm-12">
                                                <dl class="dlist-inline">
                                                
                                                    @foreach($attributes as $attribute)
                                                    @php
                                                        
                                                            if ($attribute->count() > 0) {
                                                                $attributeCheck = in_array($attribute->id, $product->attributes->pluck('attribute_id')->toArray());
                                                            } else {
                                                                $attributeCheck = [];
                                                            }
                                                        @endphp
                                                        @if ($attributeCheck)

                                                            <dd>
                                                                <select class="form-control option" style="width:180px;" id="" name="{{ strtolower($attribute->name ) }}">
                                                                    <option data-price="0" value="0"> Select a {{ $attribute->name }}</option>
                                                                    @foreach($product->attributes as $attributeValue)
                                                                        @if ($attributeValue->attribute_id == $attribute->id)
                                                                            <option
                                                                                data-price="{{ $attributeValue->price }}"
                                                                                value="{{ $attributeValue->value }}"> {{ ucwords($attributeValue->value . ' + '. $attributeValue->price) }}
                                                                            </option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </dd>
                                                        @endif
                                                    @endforeach
                                                </dl>
                                            </div>

		</div> <!-- col.// -->

		<div class="form-group col-md flex-grow-0">
			<div class="input-group mb-3 input-spinner">
				<div class="input-group-prepend">
					<button class="btn btn-light" type="button" onclick="incrementQty()" id="button-plus"> + </button>
				</div>
			  <input type="text" class="form-control" id="number" name="qty" value ="1" max="{{ $product->quantity }}" min="1">
				<div class="input-group-append">
					<button class="btn btn-light" type="button" onclick="decrementQty()" id="button-minus"> &minus; </button>
				</div>
			</div>
		</div> <!-- col.// -->

		<div class="form-group col-md">
			<input type="hidden" name="productId" value="{{ $product->id }}">
			<input type="hidden" name="price" id="finalPrice" value="{{ $product->sale_price != '' ? $product->sale_price : $product->price }}">
			<input type="hidden" name="productId" value="{{ $product->id }}">
			<button type="submit" id="addtocart" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> <span class="text">Add to cart</span> </button>
		</div> <!-- col.// -->
	</div> <!-- row.// -->
</form>

</article> <!-- product-info-aside .// -->
		</main> <!-- col.// -->
	</div> <!-- row.// -->

<!-- ================ ITEM DETAIL END .// ================= -->


</div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->

<!-- ========================= SECTION  ========================= -->
<section class="section-name padding-y bg">
<div class="container">

<div class="row">
	<div class="col-md-8">
		<h5 class="title-description">Description</h5>
		<p>{!! $product->description !!}. </p>
		<ul class="list-check">
		<li>Material: Stainless steel</li>
		<li>Weight: 82kg</li>
		<li>built-in drip tray</li>
		<li>Open base for pots and pans</li>
		<li>On request available in propane execution</li>
		</ul>

		<h5 class="title-description">Specifications</h5>
		<table class="table table-bordered">

			<tr> <th colspan="2">Dimensions</th> </tr>
			<tr> <td>Width</td><td>500mm</td> </tr>
			<tr> <td>Depth</td><td>400mm</td> </tr>
			<tr> <td>Height	</td><td>700mm</td> </tr>

		</table>
	</div> <!-- col.// -->

</div> <!-- row.// -->

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
@push('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

	function incrementQty()
	{
		var value = parseInt(document.getElementById('number').value, 10);
		value = isNaN(value) ? 0 : value;
    	value++;
    	document.getElementById('number').value = value;
	}

	function decrementQty()
	{
		var value = parseInt(document.getElementById('number').value, 10);
		value = isNaN(value) ? 0 : value;
			if(value > 1){
				value--;	
			} else{
				swal("Quantity must be greater than or equal to 1");
			}

    	document.getElementById('number').value = value;
	}

        $(document).ready(function () {
            $('#addToCart').submit(function (e) {
                if ($('.option').val() == 0) {
                    e.preventDefault();
                    swal("Please choose Attribute");
                }
            });
            $('.option').change(function () {
                $('#productPrice').html("{{ $product->sale_price != '' ? $product->sale_price : $product->price }}");
                let extraPrice = $(this).find(':selected').data('price');
                let price = parseFloat($('#productPrice').html());
                let finalPrice = (Number(extraPrice) + price).toFixed(2);
                $('#finalPrice').val(finalPrice);
                $('#productPrice').html(finalPrice);
            });
        });
    </script>
@endpush