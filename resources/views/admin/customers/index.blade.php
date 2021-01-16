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
<div class="table-responsive-md table-responsive-lg table-responsive-xl table-responsive-sm">
<table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th class="text-center"> No </th>
                            <th class="text-center"> Name </th>
                            <th class="text-center"> Email </th>
                            <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt  "> </i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customer as $key => $customers)
                            <tr>
                                <td class="text-center">{{ ++$i }}</td>
                                <td class="text-center">{{ $customers->getFullNameAttribute() }}</td>
                                <td class="text-center">{{ $customers->email }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Second group">
                                        <a href="{{ route('customers.show',$customers->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $customer->render() !!}
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready( function () {
        $('#myTable').DataTable();
    } );
    </script>
@endpush