@extends('admin.app')
@section('title') Dashboard @endsection
@section('content')
<div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
        </div>
    </div>

    <div class="container">
        <div class="row" style="padding:1em 2em;">
    @foreach($productsRequest as $key => $order)
            <div class="col-md-6" style="padding:10px;">
                <div class="card" style="width: 25rem;">
                    <div class="card-body">
                        <h5 class="card-title">Name of Item: {{ $order->name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Quantity: {{ $order->quantity }}</h6>
                        <p class="card-text">Description: {{ $order->description }}</p>
                        <p class="card-text text-muted">Date Requested: {{ $order->created_at->toFormattedDateString() }}</p>
                    </div>
                </div>
            </div>
            <br>
    @endforeach
        </div>
    </div>
@endsection