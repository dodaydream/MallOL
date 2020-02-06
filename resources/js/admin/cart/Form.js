import AppForm from '../app-components/Form/AppForm';

Vue.component('cart-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                sku:  '' ,
                inventory_id:  '' ,
                user_id:  '' ,
                qty:  '' ,
            }
        }
    }
});
