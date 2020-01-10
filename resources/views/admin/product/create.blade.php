@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.product.actions.create'))

@section('body')

    <div class="container-xl">

        <product-form
            :action="'{{ url('admin/products') }}'"
            :categories="{{ $categories->toJson() }}"
            :brands="{{ $brands->toJson() }}"
            v-cloak
            inline-template>

            <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="action" novalidate>
                
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-plus"></i> {{ trans('admin.product.actions.create') }}
                    </div>

                    <div class="card-body">
                        @include('admin.product.components.form-elements')
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-percent"></i> Promotion
                    </div>
                    <div class="card-body">
                        @include('admin.product.components.form-elements-promo')
                    </div>
                </div>

                <div class="card">
                    @include('brackets/admin-ui::admin.includes.media-uploader', [
                        'mediaCollection' => app(App\Models\Product::class)->getMediaCollection('gallery'),
                        'label' => 'Gallery'
                    ])
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-info-circle"></i> {{ trans('admin.details') }}
                    </div>

                    <div class="card-body">
                        @include('admin.product.components.form-elements-descr')
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                </div>
                
            </form>

        </product-form>

        </div>

    
@endsection
