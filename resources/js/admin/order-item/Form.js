import AppForm from '../app-components/Form/AppForm';

Vue.component('order-item-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                price:  '' ,
                total_price:  '' ,
                qty:  '' ,
                inventory_id:  '' ,
                order_id:  '' ,
                
            }
        }
    }

});