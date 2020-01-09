<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.product.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('spu'), 'has-success': fields.spu && fields.spu.valid }">
    <label for="spu" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.spu') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.spu" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('spu'), 'form-control-success': fields.spu && fields.spu.valid}" id="spu" name="spu" placeholder="{{ trans('admin.product.columns.spu') }}">
        <div v-if="errors.has('spu')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('spu') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('price'), 'has-success': fields.price && fields.price.valid }">
    <label for="price" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.price') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.price" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('price'), 'form-control-success': fields.price && fields.price.valid}" id="price" name="price" placeholder="{{ trans('admin.product.columns.price') }}">
        <div v-if="errors.has('price')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('price') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('market_price'), 'has-success': fields.market_price && fields.market_price.valid }">
    <label for="market_price" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.market_price') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.market_price" v-validate="'decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('market_price'), 'form-control-success': fields.market_price && fields.market_price.valid}" id="market_price" name="market_price" placeholder="{{ trans('admin.product.columns.market_price') }}">
        <div v-if="errors.has('market_price')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('market_price') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('promote_price'), 'has-success': fields.promote_price && fields.promote_price.valid }">
    <label for="promote_price" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.promote_price') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.promote_price" v-validate="'decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('promote_price'), 'form-control-success': fields.promote_price && fields.promote_price.valid}" id="promote_price" name="promote_price" placeholder="{{ trans('admin.product.columns.promote_price') }}">
        <div v-if="errors.has('promote_price')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('promote_price') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('is_on_sale'), 'has-success': fields.is_on_sale && fields.is_on_sale.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="is_on_sale" type="checkbox" v-model="form.is_on_sale" v-validate="''" data-vv-name="is_on_sale"  name="is_on_sale_fake_element">
        <label class="form-check-label" for="is_on_sale">
            {{ trans('admin.product.columns.is_on_sale') }}
        </label>
        <input type="hidden" name="is_on_sale" :value="form.is_on_sale">
        <div v-if="errors.has('is_on_sale')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('is_on_sale') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('is_promote'), 'has-success': fields.is_promote && fields.is_promote.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="is_promote" type="checkbox" v-model="form.is_promote" v-validate="''" data-vv-name="is_promote"  name="is_promote_fake_element">
        <label class="form-check-label" for="is_promote">
            {{ trans('admin.product.columns.is_promote') }}
        </label>
        <input type="hidden" name="is_promote" :value="form.is_promote">
        <div v-if="errors.has('is_promote')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('is_promote') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('description'), 'has-success': fields.description && fields.description.valid }">
    <label for="description" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.description') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.description" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('description'), 'form-control-success': fields.description && fields.description.valid}" id="description" name="description" placeholder="{{ trans('admin.product.columns.description') }}">
        <div v-if="errors.has('description')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('description') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('details'), 'has-success': fields.details && fields.details.valid }">
    <label for="details" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.details') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <wysiwyg v-model="form.details" v-validate="''" id="details" name="details" :config="mediaWysiwygConfig"></wysiwyg>
        </div>
        <div v-if="errors.has('details')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('details') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('category_id'), 'has-success': fields.category_id && fields.category_id.valid }">
    <label for="category_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.category_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.category_id" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('category_id'), 'form-control-success': fields.category_id && fields.category_id.valid}" id="category_id" name="category_id" placeholder="{{ trans('admin.product.columns.category_id') }}">
        <div v-if="errors.has('category_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('category_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('brand_id'), 'has-success': fields.brand_id && fields.brand_id.valid }">
    <label for="brand_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.brand_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.brand_id" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('brand_id'), 'form-control-success': fields.brand_id && fields.brand_id.valid}" id="brand_id" name="brand_id" placeholder="{{ trans('admin.product.columns.brand_id') }}">
        <div v-if="errors.has('brand_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('brand_id') }}</div>
    </div>
</div>


