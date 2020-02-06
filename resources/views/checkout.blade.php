@extends('layout')

@section('content')

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
@endsection
