<div class="form-group row align-items-center" :class="{'has-danger': errors.has('po_number'), 'has-success': fields.po_number && fields.po_number.valid }">
    <label for="po_number" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.po_number') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.po_number" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('po_number'), 'form-control-success': fields.po_number && fields.po_number.valid}" id="po_number" name="po_number" placeholder="{{ trans('admin.order.columns.po_number') }}">
        <div v-if="errors.has('po_number')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('po_number') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('completed_at'), 'has-success': fields.completed_at && fields.completed_at.valid }">
    <label for="completed_at" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.completed_at') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.completed_at" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('completed_at'), 'form-control-success': fields.completed_at && fields.completed_at.valid}" id="completed_at" name="completed_at" placeholder="{{ trans('admin.order.columns.completed_at') }}">
        <div v-if="errors.has('completed_at')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('completed_at') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('total_price'), 'has-success': fields.total_price && fields.total_price.valid }">
    <label for="total_price" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.total_price') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.total_price" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('total_price'), 'form-control-success': fields.total_price && fields.total_price.valid}" id="total_price" name="total_price" placeholder="{{ trans('admin.order.columns.total_price') }}">
        <div v-if="errors.has('total_price')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('total_price') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('user_id'), 'has-success': fields.user_id && fields.user_id.valid }">
    <label for="user_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.user_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.user_id" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('user_id'), 'form-control-success': fields.user_id && fields.user_id.valid}" id="user_id" name="user_id" placeholder="{{ trans('admin.order.columns.user_id') }}">
        <div v-if="errors.has('user_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('user_id') }}</div>
    </div>
</div>


