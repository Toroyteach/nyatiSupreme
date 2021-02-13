@extends('admin.app')
@section('title') User @endsection
@section('content')
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-left">
<h2>Users Management</h2>
</div>
<div class="pull-right">
<a class="btn btn-success btn-sm" href="{{ route('users.create') }}"> Create New Admin User</a>
</div>
</div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif
<div class="table-responsive-md table-responsive-lg table-responsive-xl table-responsive-sm">
<table class="table table-bordered">
<tr>
<th>No</th>
<th>Name</th>
<th>Email</th>
<th>Roles</th>
<th width="280px">Action</th>
</tr>
@foreach ($data as $key => $user)
<tr>
<td class="align-middle">{{ ++$i }}</td>
<td class="align-middle">{{ $user->first_name }}</td>
<td class="align-middle">{{ $user->email }}</td>
<td class="align-middle">
@if(!empty($user->getRoleNames()))
@foreach($user->getRoleNames() as $v)
<label class="badge badge-success">{{ $v }}</label>
@endforeach
@endif
</td>
<td>
<a class="btn btn-info btn-sm" href="{{ route('users.show',$user->id) }}">Show</a>
<a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}">Edit</a>
{!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
{!! Form::close() !!}
</td>
</tr>
@endforeach
</table>
</div>
{!! $data->render() !!}
@endsection