<div class="form-group row align-items-center" :class="{'has-danger': errors.has('price'), 'has-success': fields.price && fields.price.valid }">
    <label for="price" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order-item.columns.price') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.price" v-validate="'decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('price'), 'form-control-success': fields.price && fields.price.valid}" id="price" name="price" placeholder="{{ trans('admin.order-item.columns.price') }}">
        <div v-if="errors.has('price')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('price') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('total_price'), 'has-success': fields.total_price && fields.total_price.valid }">
    <label for="total_price" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order-item.columns.total_price') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.total_price" v-validate="'decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('total_price'), 'form-control-success': fields.total_price && fields.total_price.valid}" id="total_price" name="total_price" placeholder="{{ trans('admin.order-item.columns.total_price') }}">
        <div v-if="errors.has('total_price')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('total_price') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('qty'), 'has-success': fields.qty && fields.qty.valid }">
    <label for="qty" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order-item.columns.qty') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.qty" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('qty'), 'form-control-success': fields.qty && fields.qty.valid}" id="qty" name="qty" placeholder="{{ trans('admin.order-item.columns.qty') }}">
        <div v-if="errors.has('qty')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('qty') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('inventory_id'), 'has-success': fields.inventory_id && fields.inventory_id.valid }">
    <label for="inventory_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order-item.columns.inventory_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.inventory_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('inventory_id'), 'form-control-success': fields.inventory_id && fields.inventory_id.valid}" id="inventory_id" name="inventory_id" placeholder="{{ trans('admin.order-item.columns.inventory_id') }}">
        <div v-if="errors.has('inventory_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('inventory_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('order_id'), 'has-success': fields.order_id && fields.order_id.valid }">
    <label for="order_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order-item.columns.order_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.order_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('order_id'), 'form-control-success': fields.order_id && fields.order_id.valid}" id="order_id" name="order_id" placeholder="{{ trans('admin.order-item.columns.order_id') }}">
        <div v-if="errors.has('order_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('order_id') }}</div>
    </div>
</div>


