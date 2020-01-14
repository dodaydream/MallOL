@extends('layout')

@section('title', trans('admin.cart.actions.index'))

@section('content')

    <cart-listing
        :data="{{ $data->toJson() }}"
        :url="'{{ url('admin/carts') }}'"
        inline-template>

                <div class="panel is-primary">
                    <div class="panel-heading">
                        <i class="fa fa-align-justify"></i> {{ trans('admin.cart.actions.index') }}
                    </div>

                    <div class="panel-block">
                        <form @submit.prevent="">
                            <b-field grouped>
                            <b-input placeholder="{{ trans('brackets/admin-ui::admin.placeholder.search') }}" v-model="search" @keyup.enter="filter('search', $event.target.value)" expanded></b-input>
                            <b-select v-model="pagination.state.per_page">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="100">100</option>
                            </b-select>
                            </b-field>
                        </form>
                    </div>
                    <div class="panel-block" v-cloak>
                        <div>

                            <table class="table is-hoverable table-listing is-fullwidth">
                                <thead>
                                    <tr>
                                        <th class="bulk-checkbox">
                                            <input class="form-check-input" id="enabled" type="checkbox" v-model="isClickedAll" v-validate="''" data-vv-name="enabled"  name="enabled_fake_element" @click="onBulkItemsClickedAllWithPagination()">
                                            <label class="form-check-label" for="enabled">
                                                #
                                            </label>
                                        </th>

                                        <th is='sortable' :column="'id'">{{ trans('admin.cart.columns.id') }}</th>
                                        <th is='sortable' :column="'sku'">{{ trans('admin.cart.columns.sku') }}</th>
                                        <th is='sortable' :column="'inventory_id'">{{ trans('admin.cart.columns.inventory_id') }}</th>
                                        <th is='sortable' :column="'user_id'">{{ trans('admin.cart.columns.user_id') }}</th>
                                        <th is='sortable' :column="'qty'">{{ trans('admin.cart.columns.qty') }}</th>

                                        <th></th>
                                    </tr>
                                    <tr v-show="(clickedBulkItemsCount > 0) || isClickedAll">
                                        <td class="bg-bulk-info d-table-cell text-center" colspan="7">
                                            <span class="align-middle font-weight-light text-dark">{{ trans('brackets/admin-ui::admin.listing.selected_items') }} @{{ clickedBulkItemsCount }}.  <a href="#" class="text-primary" @click="onBulkItemsClickedAll('/admin/carts')" v-if="(clickedBulkItemsCount < pagination.state.total)"> <i class="fa" :class="bulkCheckingAllLoader ? 'fa-spinner' : ''"></i> {{ trans('brackets/admin-ui::admin.listing.check_all_items') }} @{{ pagination.state.total }}</a> <span class="text-primary">|</span> <a
                                                        href="#" class="text-primary" @click="onBulkItemsClickedAllUncheck()">{{ trans('brackets/admin-ui::admin.listing.uncheck_all_items') }}</a>  </span>

                                            <span class="pull-right pr-2">
                                                <button class="btn btn-sm btn-danger pr-3 pl-3" @click="bulkDelete('/admin/carts/bulk-destroy')">{{ trans('brackets/admin-ui::admin.btn.delete') }}</button>
                                            </span>

                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in collection" :key="item.id" :class="bulkItems[item.id] ? 'bg-bulk' : ''">
                                        <td class="bulk-checkbox">
                                            <input class="form-check-input" :id="'enabled' + item.id" type="checkbox" v-model="bulkItems[item.id]" v-validate="''" :data-vv-name="'enabled' + item.id"  :name="'enabled' + item.id + '_fake_element'" @click="onBulkItemClicked(item.id)" :disabled="bulkCheckingAllLoader">
                                            <label class="form-check-label" :for="'enabled' + item.id">
                                            </label>
                                        </td>

                                        <td>@{{ item.id }}</td>
                                        <td>@{{ item.sku }}</td>
                                        <td>@{{ item.inventory_id }}</td>
                                        <td>@{{ item.user_id }}</td>
                                        <td>@{{ item.qty }}</td>
                                        
                                        <td>
                                            <div class="row no-gutters">
                                                <div class="col-auto">
                                                    <a class="btn btn-sm btn-spinner btn-info" :href="item.resource_url + '/edit'" title="{{ trans('brackets/admin-ui::admin.btn.edit') }}" role="button"><i class="fa fa-edit"></i></a>
                                                </div>
                                                <form class="col" @submit.prevent="deleteItem(item.resource_url)">
                                                    <button type="submit" class="btn btn-sm btn-danger" title="{{ trans('brackets/admin-ui::admin.btn.delete') }}"><i class="fa fa-trash-o"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="row" v-if="pagination.state.total > 0">
                                <div class="col-sm">
                                    <span class="pagination-caption">{{ trans('brackets/admin-ui::admin.pagination.overview') }}</span>
                                </div>
                                <div class="col-sm-auto">
                                    <pagination></pagination>
                                </div>
                            </div>

                            <div class="no-items-found" v-if="!collection.length > 0">
                                <i class="icon-magnifier"></i>
                                <h3>{{ trans('brackets/admin-ui::admin.index.no_items') }}</h3>
                                <p>{{ trans('brackets/admin-ui::admin.index.try_changing_items') }}</p>
                                <a class="btn btn-primary btn-spinner" href="{{ url('admin/carts/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.cart.actions.create') }}</a>
                            </div>
</div>
                        </div>
                    </div>
                </div>
                <b-button type="is-primary">Checkout</b-button>
    </cart-listing>

@endsection
