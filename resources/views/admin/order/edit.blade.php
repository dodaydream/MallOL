@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.order.actions.edit', ['name' => $order->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <order-form
                :action="'{{ $order->resource_url }}'"
                :data="{{ $order->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.order.actions.edit', ['name' => $order->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.order.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </order-form>

        </div>
    
</div>

@endsection