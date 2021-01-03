@extends('admin.app')
@section('title') User @endsection
@section('content')
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-left">
<h2>Customers Management</h2>
</div>
</div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif
<table class="table table-bordered">
<tr>
<th>No</th>
<th>Name</th>
<th>Email</th>
<th>Roles</th>
<th width="280px">Action</th>
</tr>
@foreach ($customer as $key => $customers)
<tr>
<td>{{ ++$i }}</td>
<td>{{ $customers->first_name }}</td>
<td>{{ $customers->email }}</td>
<td>

</td>
<td>
<a class="btn btn-info" href="{{ route('customers.show',$customers->id) }}">Show</a>
</td>
</tr>
@endforeach
</table>
{!! $customer->render() !!}
@endsection