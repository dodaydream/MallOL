@extends('brackets/admin-ui::admin.layout.default')

@section('title', 'Dashboard')

@section('body')
    <div class="card">
        <div class="card-header">
            <div class="float-right">
                <div class="input-group mb-3">
                    <datetime v-model="date" :config="{mode: 'range', maxDate: 'today'}"></datetime>
                    <div class="input-group-append">
                        <button class="btn btn-primary" @click="changeDateFilter">Filter</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            {{ $bestSaleReport->render() }}
        </div>
    </div>
@endsection
