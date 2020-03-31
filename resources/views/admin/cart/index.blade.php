@extends('layout')

@section('title', 'Shopping Cart')

@section('content')

<cart-listing
    :data="{{ $data->toJson() }}"
    :url="'{{ url('carts') }}'"
    inline-template>

<div>
  <div class="panel is-primary">
    <div class="panel-heading">
      <i class="fa fa-align-justify"></i> Shopping Cart
        <div class="float-right">Total: MOP$ @{{ collection.reduce((acc, item) => acc + item.qty * item.inventory.product.price, 0).toFixed(2) }}</div>
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
      <div style="width: 100%">
        <table class="table is-hoverable table-listing is-fullwidth">
        <thead>
          <tr>
            <th class="bulk-checkbox">
              <b-checkbox id="enabled" type="checkbox" v-model="isClickedAll" v-validate="''" data-vv-name="enabled"  name="enabled_fake_element" @click="onBulkItemsClickedAllWithPagination()"></b-checkbox>
            </th>
            <th>{{ trans('admin.product.columns.name') }}</th>
            <th>{{ trans('admin.cart.columns.qty') }}</th>
            <th>{{ trans('admin.product.columns.price') }}</th>
            <th>Total</th>
            <th></th>
          </tr>
          <tr v-show="(clickedBulkItemsCount > 0) || isClickedAll">
              <td class="bg-bulk-info d-table-cell text-center" colspan="7">
                          <b-notification class="align-middle font-weight-light text-dark" :closable="false">{{ trans('brackets/admin-ui::admin.listing.selected_items') }} @{{ clickedBulkItemsCount }}.  <a href="#" class="text-primary" @click="onBulkItemsClickedAll('/carts')" v-if="(clickedBulkItemsCount < pagination.state.total)"> <i class="fa" :class="bulkCheckingAllLoader ? 'fa-spinner' : ''"></i> {{ trans('brackets/admin-ui::admin.listing.check_all_items') }} @{{ pagination.state.total }}</a> <span class="text-primary">|</span> <a
                                      href="#" class="text-primary" @click="onBulkItemsClickedAllUncheck()">{{ trans('brackets/admin-ui::admin.listing.uncheck_all_items') }}</a> 

            <b-button type="is-danger" @click="bulkDelete('/carts/bulk-destroy')">{{ trans('brackets/admin-ui::admin.btn.delete') }}</b-button>
 </b-notification>
              </td>
          </tr>
        </thead>
      <tbody>
        <tr v-for="(item, index) in collection" :key="item.id" :class="bulkItems[item.id] ? 'bg-bulk' : ''">
       <td class="bulk-checkbox">
                                    <b-checkbox class="form-check-input" :id="'enabled' + item.id" type="checkbox" v-model="bulkItems[item.id]" v-validate="''" :data-vv-name="'enabled' + item.id"  :name="'enabled' + item.id + '_fake_element'" @click="onBulkItemClicked(item.id)" :disabled="bulkCheckingAllLoader"></b-checkbox>
                                    <label class="form-check-label" :for="'enabled' + item.id">
                                    </label>
                                </td>

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
      <a :href="`/product/${item.inventory.product.id}`"><strong>@{{item.inventory.product.name}}</strong></a><br>
  <small>@{{ item.inventory.sku }}</small><br>
  <b-tag type="is-primary">@{{ item.inventory.product_attr }}</b-tag> 
  </p>
  </div>
  </div>
                                </td>
                                <td><b-numberinput :value="item.qty"
@input="changeQty($event, item.id)"
                            controls-position="compact" 
:min="1"
:max="999"
></b-numberinput></td>
                                <td>MOP$ @{{ item.inventory.product.price}}</td>
                                <td>MOP$ @{{ (item.qty * item.inventory.product.price).toFixed(2) }}</td>
                                
                                <td>
                                            <b-button type="is-danger" class="btn btn-sm btn-danger" title="{{ trans('brackets/admin-ui::admin.btn.delete') }}" @click="deleteItem(item.resource_url)"><b-icon icon="delete"></b-icon></b-button>
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
                <b-button type="is-primary" @click="checkout">Checkout</b-button>
</div>
</cart-listing>


@endsection
