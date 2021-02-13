@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
                </div>
                <div class="col-sm-8">
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary pull-right">Add Category</a>
                </div>
            </div>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered table-responsive-md table-responsive-lg table-responsive-xl table-responsive-sm" id="sampleTable">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Name </th>
                                <th> Slug </th>
                                <th class="text-center"> Parent </th>
                                <th class="text-center"> Featured </th>
                                <th class="text-center"> Menu </th>
                                <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                @if ($category->id != 1)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>{{ $category->parent->name }}</td>
                                        <td class="text-center">
                                            @if ($category->featured == 1)
                                                <span class="badge badge-success">Yes</span>
                                            @else
                                                <span class="badge badge-danger">No</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($category->menu == 1)
                                                <span class="badge badge-success">Yes</span>
                                            @else
                                                <span class="badge badge-danger">No</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Second group">
                                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit Category"><i class="fa fa-edit"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script type="text/javascript">

    $(document).ready(function() {
        $("#deleteCategory").click(function(){

            swal({
                title: "Are you sure?",
                text: "Once Status has been Completed Cannot be reverted. Note some products depend on categories",
                icon: "warning",
                buttons: true,
                dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            //var deletePostUri = "{{ route('admin.categories.delete', '$(this).data("id")')}}";
        } else {

        }
        });

        }); 
    });
    </script>
@endpush
