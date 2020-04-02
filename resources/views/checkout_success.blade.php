@extends('layout')

@section('title', 'Checkout Success')

@section('content')
<div class="card">
    <header class="card-header">
        <p class="card-header-title">
            Shipping Address
        </p>
    </header>
    <div class="card-content">
        <div class="content">
            <p>{{ Auth::user()->name }}</p>
            {!! nl2br(Auth::user()->address) !!}
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
            <td>
                @if ($item->inventory->product->is_promote)
                    <del class="has-text-grey">MOP$ {{ $item->inventory->product->price}}</del>
                    <span class="has-text-danger">MOP$ {{ $item->inventory->product->promote_price }}</span>
                @else
                    MOP$ {{ $item->inventory->product->price}}
                @endif
            </td>

            <td>
                @if ($item->inventory->product->is_promote)
                    <del class="has-text-grey">MOP$ {{ number_format($item->qty * $item->inventory->product->price, 2) }}</del>
                    <span class="has-text-danger">MOP$ {{ number_format($item->qty * $item->inventory->product->promote_price, 2) }}</span>
                @else
                    MOP$ {{ number_format($item->qty * $item->inventory->product->price, 2) }}
                @endif
            </td>

                                
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
