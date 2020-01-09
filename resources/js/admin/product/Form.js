import AppForm from '../app-components/Form/AppForm';

Vue.component('product-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                spu:  '' ,
                price:  '' ,
                market_price:  '' ,
                promote_price:  '' ,
                is_on_sale:  false ,
                is_promote:  false ,
                description:  '' ,
                details:  '' ,
                category_id:  '' ,
                brand_id:  '' ,
                
            }
        }
    }

});