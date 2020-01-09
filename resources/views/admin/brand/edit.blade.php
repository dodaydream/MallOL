@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.brand.actions.edit', ['name' => $brand->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <brand-form
                :action="'{{ $brand->resource_url }}'"
                :data="{{ $brand->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.brand.actions.edit', ['name' => $brand->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.brand.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </brand-form>

        </div>
    
</div>

@endsection