@extends('admin.app')
@section('content')
<section class="padding-bottom padding-top">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1>
                    Oops!</h1>
                <div class="error-details">
                    Sorry, You do not have the required permissions
                </div>
                <div class="error-actions">
                    <a href="{{route('admin.dashboard')}}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-home">Home</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@stop