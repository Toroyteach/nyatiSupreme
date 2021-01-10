@extends('admin.app')
@section('title') Users @endsection
@section('content')
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-left">
<h2> Show Customers</h2>
</div>
<div class="pull-right">
<a class="btn btn-primary" href="{{ route('customers.index') }}"> Back</a>
</div>
</div>
</div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Name:</strong>
{{ $customers->getFullNameAttribute() }}
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Email:</strong>
{{ $customers->email }}
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Phone Number:</strong>
{{ $customers->phonenumber }}
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Address:</strong>
{{ $customers->address }}
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>City:</strong>
{{ $customers->city }}
</div>
</div>
</div>
@endsection