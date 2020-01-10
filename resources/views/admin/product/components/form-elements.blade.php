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



<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('category_id'), 'has-success': this.fields.category_id && this.fields.category_id.valid }">
    <label for="category_id"
           class="col-form-label text-md-right col-md-2">{{ trans('admin.product.columns.category_id') }}</label>
    <div class="col-md-9 col-xl-8">

        <multiselect
            searchable
            v-model="opt.category"
            @input="optChange"
            :options="categories"
            :multiple="false"
            track-by="id"
            label="name"
            tag-placeholder="{{ __('Select Category') }}"
            placeholder="{{ __('Category') }}">
        </multiselect>

        <div v-if="errors.has('category_id')" class="form-control-feedback form-text" v-cloak>@{{
            errors.first('category_id') }}
        </div>
    </div>
</div>

<div class="form-group row align-items-center"
     :class="{'has-danger': errors.has('brand_id'), 'has-success': this.fields.brand_id && this.fields.brand_id.valid }">
    <label for="brand_id"
           class="col-form-label text-md-right col-md-2">{{ trans('admin.product.columns.brand_id') }}</label>
    <div class="col-md-9 col-xl-8">

        <multiselect
            searchable
            v-model="opt.brand"
            @input="optChange"
            :options="brands"
            :multiple="false"
            track-by="id"
            label="name"
            tag-placeholder="{{ __('Select Brand') }}"
            placeholder="{{ __('Brand') }}">
        </multiselect>

        <div v-if="errors.has('brand_id')" class="form-control-feedback form-text" v-cloak>@{{
            errors.first('brand_id') }}
        </div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('is_on_sale'), 'has-success': fields.is_on_sale && fields.is_on_sale.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="is_on_sale" type="checkbox" v-model="form.is_on_sale" v-validate="''" data-vv-name="is_on_sale"  name="is_on_sale_fake_element">
        <label class="form-check-label" for="is_on_sale">
            {{ trans('admin.product.columns.on_sale') }}
        </label>
        <input type="hidden" name="is_on_sale" :value="form.is_on_sale">
        <div v-if="errors.has('is_on_sale')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('is_on_sale') }}</div>
    </div>
</div>
