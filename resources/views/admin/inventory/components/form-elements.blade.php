<div class="form-group row align-items-center" :class="{'has-danger': errors.has('product_id'), 'has-success': fields.product_id && fields.product_id.valid }">
    <label for="product_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.inventory.columns.product_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.product_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('product_id'), 'form-control-success': fields.product_id && fields.product_id.valid}" id="product_id" name="product_id" placeholder="{{ trans('admin.inventory.columns.product_id') }}">
        <div v-if="errors.has('product_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('product_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('product_attr'), 'has-success': fields.product_attr && fields.product_attr.valid }">
    <label for="product_attr" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.inventory.columns.product_attr') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.product_attr" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('product_attr'), 'form-control-success': fields.product_attr && fields.product_attr.valid}" id="product_attr" name="product_attr" placeholder="{{ trans('admin.inventory.columns.product_attr') }}">
        <div v-if="errors.has('product_attr')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('product_attr') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('sku'), 'has-success': fields.sku && fields.sku.valid }">
    <label for="sku" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.inventory.columns.sku') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.sku" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('sku'), 'form-control-success': fields.sku && fields.sku.valid}" id="sku" name="sku" placeholder="{{ trans('admin.inventory.columns.sku') }}">
        <div v-if="errors.has('sku')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('sku') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('qty'), 'has-success': fields.qty && fields.qty.valid }">
    <label for="qty" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.inventory.columns.qty') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.qty" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('qty'), 'form-control-success': fields.qty && fields.qty.valid}" id="qty" name="qty" placeholder="{{ trans('admin.inventory.columns.qty') }}">
        <div v-if="errors.has('qty')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('qty') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('shelf'), 'has-success': fields.shelf && fields.shelf.valid }">
    <label for="shelf" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.inventory.columns.shelf') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.shelf" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('shelf'), 'form-control-success': fields.shelf && fields.shelf.valid}" id="shelf" name="shelf" placeholder="{{ trans('admin.inventory.columns.shelf') }}">
        <div v-if="errors.has('shelf')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('shelf') }}</div>
    </div>
</div>


