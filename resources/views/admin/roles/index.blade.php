@extends('admin.app')
@section('title') Role @endsection
@section('content')
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-left">
<h2>Role Management</h2>
</div>
<div class="pull-right">
@can('role-create')
<a class="btn btn-success btn-sm" href="{{ route('roles.create') }}"> Create New Role</a>
@endcan
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
<th width="280px">Action</th>
</tr>
@foreach ($roles as $key => $role)
<tr>
<td class="align-middle">{{ ++$key }}</td>
<td class="align-middle">{{ $role->name }}</td>
<td>
<a class="btn btn-info btn-sm" href="{{ route('roles.show',$role->id) }}">Show</a>
@can('role-edit')
<a class="btn btn-primary btn-sm" href="{{ route('roles.edit',$role->id) }}">Edit</a>
@endcan
@can('role-delete')
{!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
{!! Form::close() !!}
@endcan
</td>
</tr>
@endforeach
</table>
{!! $roles->render() !!}
</div>
@endsection