import AppForm from '../app-components/Form/AppForm';

Vue.component('inventory-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                product_id:  '' ,
                product_attr:  '' ,
                sku:  '' ,
                qty:  '' ,
                shelf:  '' ,
                
            }
        }
    }

});