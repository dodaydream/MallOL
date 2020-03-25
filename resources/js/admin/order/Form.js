import AppForm from '../app-components/Form/AppForm';

Vue.component('order-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                po_number:  '' ,
                completed_at:  '' ,
                total_price:  '' ,
                user_id:  '' ,
                
            }
        }
    }

});