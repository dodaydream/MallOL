<div class="form-group row align-items-center" :class="{'has-danger': errors.has('promote_price'), 'has-success': fields.promote_price && fields.promote_price.valid }">
    <label for="promote_price" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.promote_price') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.promote_price" v-validate="'decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('promote_price'), 'form-control-success': fields.promote_price && fields.promote_price.valid}" id="promote_price" name="promote_price" placeholder="{{ trans('admin.product.columns.promote_price') }}">
        <div v-if="errors.has('promote_price')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('promote_price') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('is_promote'), 'has-success': fields.is_promote && fields.is_promote.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="is_promote" type="checkbox" v-model="form.is_promote" v-validate="''" data-vv-name="is_promote"  name="is_promote_fake_element">
        <label class="form-check-label" for="is_promote">
            {{ trans('admin.product.columns.promote') }}
        </label>
        <input type="hidden" name="is_promote" :value="form.is_promote">
        <div v-if="errors.has('is_promote')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('is_promote') }}</div>
    </div>
</div>
