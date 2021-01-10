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
                <section class="invoice">
                    <div class="row mb-4">
                        <div class="col-6">
                            <h2 class="page-header"><i class="fa fa-globe"></i> {{ $order->order_number }}</h2>
                        </div>
                        <div class="col-6">
                            <h5 class="text-right">Date: {{ $order->created_at->toFormattedDateString() }}</h5>
                        </div>
                    </div>
                    <div class="row invoice-info">
                        <div class="col-3">Placed By
                            <address><strong>{{ $order->user->fullName }}</strong><br>Email: {{ $order->user->email }}</address>
                        </div>
                        <div class="col-3">Ship To
                            <address><strong>{{ $order->first_name }} {{ $order->last_name }}</strong><br>{{ $order->address }}<br>{{ $order->city }}, {{ $order->country }} {{ $order->post_code }}<br>{{ $order->phone_number }}<br></address>
                        </div>
                        <div class="col-6">
                            <b>Order ID:</b> {{ $order->order_number }}<br>
                            <b>Amount:</b> {{ config('settings.currency_symbol') }}{{ round($order->grand_total, 2) }}<br>
                            <b>Payment Method:</b> {{ $order->payment_method }}<br>
                            <b>Payment Status:</b> {{ $order->payment_status == 1 ? 'Completed' : 'Not Completed' }}<br>
                            <b>Order Status:</b> {{ $order->status }}<br>
                        </div>
                    </div><br>
                    <div class="row">

                    <div class="alert alert-success" role="alert" id="showSuccess" style="display:none;">
                        The order Status was succesfully Completed !
                        </div>

                            @if($order->status =='completed')         
                            <div class="alert alert-danger col-lg-12 text-center" role="alert">
                            Order is Already {{ $order->status }} !!
                                </div>      
                            @else
                        <div class="alert alert-primary col-4" role="alert" id="hide">
                            <p>Change Status of the order</p>
                        </div>

                        <div class="col-6" id="statusForm">
                        <form action="{{ route('ordersUpdate') }}" method="POST" role="form" id="update">
                            <input type="hidden" name="id" id="id" value="{{ $order->order_number }}">
                        @csrf
                            <div class="form-group">
                                <select class="form-control" id="controlformselector" name="status">
                                <option value="{{ $order->status }}" seleted>{{ $order->status }}</option>
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="completed">Completed</option>
                                <option value="declined">Declined</option>
                                </select>
                            </div>
                                <button type="submit" class="btn btn-primary float-right">Submit</button>  
                                </form> 
                                </div>     
                            @endif
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script type="text/javascript">

$('#update').on('submit',function(event){
    event.preventDefault();

    var form = document.getElementById("statusForm");
    var success = document.getElementById("showSuccess");
    var hideForm = document.getElementById("hide");

    let status = $('#controlformselector').val();
    let id = $('#id').val();

    if (status == 'completed') {

        swal({
        title: "Are you sure?",
        text: "Once Status has been Completed Cannot be reverted. An Email wil be sent to Client",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {

            $.ajax({
            url: "{{ route('ordersUpdate') }}",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                status:status,
                id:id,
            },
            success:function(response){
                console.log(response);

                form.style.display = "none";//removes the form dive
                success.style.display = "block";//adds the success alert bootstrap
                hideForm.style.display = "none";

            },
            });

            swal("An email has been sent to customer on order status", {
            icon: "success",
            });
        } else {
            swal("You have Halted this action");
        }
        });
        console.log(status);

    } else {
        $.ajax({
            url: "{{ route('ordersUpdate') }}",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                status:status,
                id:id,
            },
            success:function(response){
                console.log(response);
            },
            });
        swal("Order Status Update!", `you have changed status to ${status}`, "success");

    }


    });
  </script>
@endsection