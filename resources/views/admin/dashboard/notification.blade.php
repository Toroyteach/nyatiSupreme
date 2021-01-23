@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
        </div>
    </div>
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Notifications
                </div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        @forelse($notifications as $notification)

                        @if ($notification->data['type'] == 'New Order')

                            <div class="alert alert-success" role="alert">
                                <a href="{{ route('admin.orders.show', $notification->data['order_id']) }}">Customer {{ $notification->data['first_name'] }} has placed an order. Order id {{ $notification->data['order_id'] }} on [{{ Carbon\Carbon::parse($notification->created_at) }}]</a>
                                <a href="#" class="float-right mark-as-read" data-id="{{ $notification->id }}">
                                    Mark as read
                                </a>
                            </div>

                        @endif

                        @if ($notification->data['type'] == 'Completed Order')

                        <div class="alert alert-success" role="alert">
                            <a href="{{ route('admin.orders.show', $notification->data['order_id']) }}">Customer {{ $notification->data['first_name'] }}'s Order is now complete.</a>
                            <a href="#" class="float-right mark-as-read" data-id="{{ $notification->id }}">
                                Mark as read
                            </a>
                        </div>

                        @endif

                            @if($loop->last)
                                <a href="#" id="mark-all">
                                    Mark all as read
                                </a>
                            @endif
                        @empty
                            There are no new notifications
                        @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@parent
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
    function sendMarkRequest(id = null) {
        return $.ajax("{{ route('markNotification') }}", {
            method: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                id
            }
        });
    }
    $(function() {
        $('.mark-as-read').click(function() {
            let request = sendMarkRequest($(this).data('id'));
            request.done(() => {
                $(this).parents('div.alert').remove();
            });
        });
        $('#mark-all').click(function() {
            let request = sendMarkRequest();
            request.done(() => {
                $('div.alert').remove();
            })
        });
    });
    </script>
@endsection