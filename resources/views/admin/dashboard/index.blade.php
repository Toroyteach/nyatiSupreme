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
                <i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                    <h5>Customers</h5>
                    <p><b>{{$userCount}}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon">
                <i class="icon fa fa-tasks fa-3x"></i>
                <div class="info">
                    <h5>Pending Orders</h5>
                    <p><b>{{$pendingOrders}}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon">
                <i class="icon fa fa-files-o fa-3x"></i>
                <div class="info">
                    <h5>Completed Orders</h5>
                    <p><b>{{$completedOrders}}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small danger coloured-icon">
                <i class="icon fa fa-exclamation-circle fa-3x"></i>
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
            <div id="chart" style="height: 300px;"></div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div id="chart2" style="height: 300px;"></div>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-md-6 col-lg-6">
            
        </div>
        <div class="col-md-6 col-lg-6">
        <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Recent Orders</div>
                     
                <div class="card-body">
                  <datatable-component></datatable-component>
                </div>
                 
            </div>
        </div>
    </div>
</div>
        </div>
    </div>

    <script src="https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>
    <script>
const chart = new Chartisan({
  el: '#chart',
  url: 'https://chartisan.dev/chart/example.json',
  hooks: new ChartisanHooks()
    .beginAtZero()
    .colors()
    .borderColors()
    .datasets([{ type: 'line', fill: false }, 'bar']),
});

const chart2 = new Chartisan({
  el: '#chart2',
  url: 'https://chartisan.dev/chart/example.json',
  hooks: new ChartisanHooks()
    .beginAtZero()
    .colors()
    .borderColors()
    .datasets([{ type: 'line', fill: false }, 'bar']),
});
        
    </script>
@endsection