@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-bar-chart"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body table-responsive-md table-responsive-lg table-responsive-xl table-responsive-sm">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th> Order Number </th>
                            <th> Placed By </th>
                            <th class="text-center"> Total Amount </th>
                            <th class="text-center"> Items Qty </th>
                            <th class="text-center"> Payment Status </th>
                            <th class="text-center"> Order Status </th>
                            <th class="text-center"> Date Created </th>
                            <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->user->fullName }}</td>
                                <td class="text-center">{{ config('settings.currency_symbol') }}{{ $order->grand_total }}</td>
                                <td class="text-center">{{ $order->item_count }}</td>
                                <td class="text-center">
                                    @if ($order->payment_status == 1)
                                        <span class="badge badge-success">Completed</span>
                                    @else
                                        @if($order->payment_method === 'nopaymentset')
                                            <span class="badge badge-warning">No Payment Method set</span>
                                        @else
                                            <span class="badge badge-danger">Not Completed</span>
                                        @endif
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($order->status == 'completed')
                                    <span class="badge badge-success">{{ $order->status }}</span>
                                    @else
                                    <span class="badge badge-warning">{{ $order->status }}</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $order->created_at->toFormattedDateString() }} </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Second group">
                                        <a href="{{ route('admin.orders.show', $order->order_number) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="View order"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('admin.orders.edit', $order->order_number) }}" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Update order status"><i class="fa fa-edit"></i></a>
                                    </div>
                                </td>
                            </tr>
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
    <script type="text/javascript">
        //$('#sampleTable').DataTable();

        var table = $('#sampleTable').DataTable({
            "bStateSave" : true,
            "order": [[ 7, "desc" ]], //or asc 
            "columnDefs" : [{"targets":7, "type":"date-eu"}],
        });
    </script>
@endpush
