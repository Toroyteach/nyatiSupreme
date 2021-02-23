<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
    <title>{{env('APP_NAME')}} PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/fontawesome.min.css" integrity="sha512-kJ30H6g4NGhWopgdseRb8wTsyllFUYIx3hiUwmGAkgA9B/JbzUBDQVr2VVlWGde6sdBVOG7oU8AL35ORDuMm8g==" crossorigin="anonymous" />
    <style>

    </style>
  </head>
  <body>
<div class="bg">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
            <h2>Order Information</h2>
                <p>Order: {{ $order->order_number }}</p>
                <p class="font-italic">Date: {{ $order->created_at->toFormattedDateString() }}</p>

            </div>

            <div class="col-md-4">
                <div>
                    <img src="{{ asset('frontend/cssfiles/images/Nyati_logo_png.png') }}" class="float-right" width="150" alt="Responsive image">
                </div>
            </div>
        </div>
    </div>

  <div class="container">
                        <div class="row">
                            <div class="col-12">
                            <b>Order ID:</b> {{ $order->order_number }}<br>
                            <b>Amount:</b> {{ config('settings.currency_symbol') }}{{ round($order->grand_total, 2) }}<br>
                            <b>Payment Status:</b> {{ $order->payment_status == 1 ? 'Completed' : 'Not Completed' }}<br>
                            <b>Order Status:</b> {{ $order->status }}<br>
                        </div>
    </div>
  </div>

<br>
  <div class="container">
    <div class="row">
            <div class="col-md-4">
            <p class="font-italic">Placed by:</p>
                <address>
                    <strong>{{ $order->user->fullName }}</strong><br>
                    Email: {{ $order->user->email }}<br>
                    Number: {{ $order->user->phonenumber }}<br>
                </address>
            <p class="font-italic">Ship to:</p>
                <address>
                    <strong>{{ $order->first_name }} {{ $order->last_name }}</strong><br>
                    Address: {{ $order->address }}<br>
                    Town: {{ $order->city }} <br> 
                    Post-Code: {{ $order->post_code }}<br>
                    <abbr title="Phone">Phone:</abbr> {{ $order->phone_number }}
                </address>
            </div>
    </div>
  </div>

<br>
  <div class="container">
        <div class="page-header">
                    <h4>Order items</h4>
            </div>
    <div class="card">
            <table class="table table-sm">
            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product</th>
                                    <th>Attribute #</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                                </thead>
                <tbody>
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ $item->attribute }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ config('settings.currency_symbol') }}{{ round($item->price, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
            </table>
    </div>
  </div>
  </div>
  </body>
</html>
