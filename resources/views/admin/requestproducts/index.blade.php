@extends('admin.app')
@section('title') Dashboard @endsection
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Requested Products
                </div>

            </div>
        </div>
    </div>
</div>
<br>

    @foreach($productsRequest as $key => $order)
        <div class="card" style="width: 25rem;">
            <div class="card-body">
                <h5 class="card-title">Name of Item: {{ $order->name }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">Quantity: {{ $order->quantity }}</h6>
                <p class="card-text">Description: {{ $order->description }}</p>
            </div>
        </div>
        <br>
    @endforeach

@endsection