<div class="form-group row align-items-center" :class="{'has-danger': errors.has('sku'), 'has-success': fields.sku && fields.sku.valid }">
    <label for="sku" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.cart.columns.sku') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.sku" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('sku'), 'form-control-success': fields.sku && fields.sku.valid}" id="sku" name="sku" placeholder="{{ trans('admin.cart.columns.sku') }}">
        <div v-if="errors.has('sku')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('sku') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('inventory_id'), 'has-success': fields.inventory_id && fields.inventory_id.valid }">
    <label for="inventory_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.cart.columns.inventory_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.inventory_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('inventory_id'), 'form-control-success': fields.inventory_id && fields.inventory_id.valid}" id="inventory_id" name="inventory_id" placeholder="{{ trans('admin.cart.columns.inventory_id') }}">
        <div v-if="errors.has('inventory_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('inventory_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('user_id'), 'has-success': fields.user_id && fields.user_id.valid }">
    <label for="user_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.cart.columns.user_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.user_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('user_id'), 'form-control-success': fields.user_id && fields.user_id.valid}" id="user_id" name="user_id" placeholder="{{ trans('admin.cart.columns.user_id') }}">
        <div v-if="errors.has('user_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('user_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('qty'), 'has-success': fields.qty && fields.qty.valid }">
    <label for="qty" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.cart.columns.qty') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.qty" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('qty'), 'form-control-success': fields.qty && fields.qty.valid}" id="qty" name="qty" placeholder="{{ trans('admin.cart.columns.qty') }}">
        <div v-if="errors.has('qty')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('qty') }}</div>
    </div>
</div>


