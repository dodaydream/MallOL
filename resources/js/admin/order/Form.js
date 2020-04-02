import AppForm from '../app-components/Form/AppForm';

Vue.component('order-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                po_number: '',
                completed_at: '',
                total_price: '',
                user_id: '',
                status: 'pending'
            }
        }
    },
    methods: {
        updateOrderStatus(status) {
            const prevStatus = this.form.status
            this.form.status = status;
            window.axios.post(this.action, this.form).then(({data}) => {
                this.$notify({
                    type: 'success',
                    title: 'Success!',
                    text: 'Order status changed to' + status
                });
            }).catch(e => {
                this.$notify({
                    type: 'error',
                    title: 'Failed!',
                    text: e.response.data.message,
                });
                this.form.status = prevStatus
            })
        }
    }

});