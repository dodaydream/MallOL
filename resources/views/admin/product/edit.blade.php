@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.product.actions.edit', ['name' => $product->name]))

@section('body')

    <div class="container-xl">

            <product-form
                :action="'{{ $product->resource_url }}'"
                :data="{{ $product->toJson() }}"
                :categories="{{ $categories->toJson() }}"
                :brands="{{ $brands->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>

                    <div class="row">
                        <div class="col-md-7 col-lg-8">

                            <div class="card">

                                <div class="card-header">
                                    <i class="fa fa-pencil"></i> {{ trans('admin.product.actions.edit', ['name' => $product->name]) }}
                                </div>

                                <div class="card-body">
                                    @include('admin.product.components.form-elements')
                                </div>
                            </div>


                            <div class="card">
                                    @include('brackets/admin-ui::admin.includes.media-uploader', [
                                        'mediaCollection' => app(App\Models\Product::class)->getMediaCollection('gallery'),
                                        'media' => $product->getThumbs200ForCollection('gallery'),
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
                            </div>
                        </div>

                        <div class="col-md-5 col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-percent"></i> Promotion
                                </div>
                                <div class="card-body">
                                    @include('admin.product.components.form-elements-promo')
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-truck"></i> Inventory
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex" v-for="inv in data.inventories">
                                        <div class="d-flex align-items-center pr-3">
                                            <span class="lead">@{{inv.product_attr}}</span>
                                        </div>
                                        <div class="flex-grow-1">
                                            @{{ inv.sku }}<br>
                                            @{{ inv.shelf }}
                                        </div>
                                        <div>
                                            <span class="badge badge-primary">@{{inv.qty}} in stock</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
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
