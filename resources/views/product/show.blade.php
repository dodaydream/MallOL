@extends('layout')

@section('content')

<product
    :product="{{$product}}"
    :media="{{
$product->getMedia('gallery')->map(function ($media) { return [
    'id' => $media->id,
    'url' => $media->getUrl(),
    'thumb' => $media->getUrl('thumb_200')
]; })

}}"></product>

@endsection
