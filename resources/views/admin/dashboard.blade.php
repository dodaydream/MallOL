@extends('brackets/admin-ui::admin.layout.default')

@section('title', 'Dashboard')

@section('body')
    <div class="card">
        <div class="card-body">
            {{ $bestSaleReport->render() }}
        </div>
    </div>
@endsection
