@extends('layout')

@section('content')
<div class="card">
    <header class="card-header">
        <p class="card-header-title">
            Shipping Address
        </p>
    </header>
    <div class="card-content">
        <div class="content">
        <p>John Doe</p>
        1600 Amphitheatre Parkway
        <br>
        Mountain View, California
        <br>United States
        </div>
    </div>
</div>

<div class="card">
    <header class="card-header">
        <p class="card-header-title">
            Order details
        </p>
    </header>
    <div class="content">
       <table class="table is-hoverable table-listing is-fullwidth">
        <thead>
          <tr>
            <th>{{ trans('admin.product.columns.name') }}</th>
            <th>{{ trans('admin.cart.columns.qty') }}</th>
            <th>{{ trans('admin.product.columns.price') }}</th>
            <th>Total</th>
            <th></th>
          </tr>
        </thead>
      <tbody>
@foreach ($data as $item)
        <tr>
                                <td>
                                  <div class="media">
  <figure class="media-left">
  <p class="image is-64x64">
  <img src="https://bulma.io/images/placeholders/128x128.png">
  </p>
  </figure>
  <div class="media-content">
  <div class="content">
  <p>
  <strong>{{$item->inventory->product->name}}</strong>       
  <small>{{ $item->inventory->sku }}</small><br>
  <b-tag type="is-primary">{{ $item->inventory->product_attr }}</b-tag> 
  </p>
  </div>
  </div>
                                </td>
                                <td>{{ $item->qty }}</td>
                                <td>MOP$ {{ $item->inventory->product->price}}</td>
                                <td>MOP$ {{ number_format($item->qty * $item->inventory->product->price, 2) }}</td>
                                
                            </tr>
@endforeach
      </tbody>
        </table>
</div>
</div>

<div class="card">
    <header class="card-header">
        <p class="card-header-title">
            Order Details
        </p>
    </header>
    <div class="card-content">
        <div class="content">
        <strong>P.O. Number: </strong>{{ $order->po_number }}<br>
        <strong>Created At: </strong>{{ $order->created_at }}<br>
        <strong>Sub-total: </strong>MOP$ {{ $order->total_price }}
        </div>
    </div>
</div>
@endsection
