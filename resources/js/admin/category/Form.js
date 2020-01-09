import AppForm from '../app-components/Form/AppForm';

Vue.component('category-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                
            }
        }
    }

});