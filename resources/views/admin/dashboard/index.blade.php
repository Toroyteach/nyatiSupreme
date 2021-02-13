@extends('admin.app')
@section('title') Dashboard @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon">
            <a href="{{ route('customers.index') }}">
                <i class="icon fa fa-users fa-3x"></i>
                </a>
                <div class="info">
                    <h5>Customers</h5>
                    <p><b>{{$userCount}}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon">
            <a href="{{ route('admin.orders.index') }}">
                <i class="icon fa fa-tasks fa-3x"></i>
                </a>
                <div class="info">
                    <h5>Pending Orders</h5>
                    <p><b>{{$pendingOrders}}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon">
            <a href="{{ route('admin.orders.index') }}">
                <i class="icon fa fa-files-o fa-3x"></i>
                </a>
                <div class="info">
                    <h5>Completed Orders</h5>
                    <p><b>{{$completedOrders}}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small danger coloured-icon">
            <a href="{{ route('admin.notification') }}">
                <i class="icon fa fa-exclamation-circle fa-3x"></i>
                </a>
                <div class="info">
                    <h5>Pending Notifications</h5>
                    <p><b>{{$countnotifications}}</b></p>
                </div>
            </div>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="card">
            <div class="card-header">Daily Sales</div>
            {!! $chartjs->render() !!}
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="card">
            <div class="card-header">Top sellers</div>
            {!! $chartjs2->render() !!}
            </div>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-md-6 col-lg-6">
        <div class="card">
                <div class="card-header">Recent Orders</div>
                     
                <div class="card-body table-responsive-md table-responsive-lg table-responsive-xl table-responsive-sm">
                <table class="table table-hover">

                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Order</th>
                    <th scope="col">Date Placed</th>
                    <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>

                @foreach ($topOrders as $key => $order)
                <tr id="">
                    <td>{{$key+1}}</td>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->created_at->toFormattedDateString() }}</td>
                    <td>{{ config('settings.currency_symbol').' '.$order->grand_total }}</td>
                @endforeach

                </tbody>
                </table>
                </div>
                 
            </div>
        </div>
        <div class="col-md-6 col-lg-6">


                <div class="card" >
                    <div class="card-header">Top Customers</div>
                        <div class="card-body table-responsive-md table-responsive-lg table-responsive-xl table-responsive-sm">
                            <table class="table table-hover">

                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Revenue</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($topCustomers as $key => $customer)
                            <tr id="">
                                <td>{{$key+1}}</td>
                                <td>{{ $customer->first_name }}</td>
                                <td>{{ config('settings.currency_symbol').' '.$customer->revenue }}</td>
                            @endforeach

                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    </div>

    <script src="https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>
    <script src="//code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script type=text/javascript>
      $(document).ready(function() {
        $("#getData").click(function() { 
         $.ajax({  //create an ajax request to display.php
          type: "GET",
          url: "get-top-orders/",       
          success: function (data) {
            $("#title").html(data.title);
            $("#description").html(data.description);
          }
        });
      });
      });
      
      </script>
@endsection