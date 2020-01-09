import AppForm from '../app-components/Form/AppForm';

Vue.component('brand-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                
            }
        }
    }

});