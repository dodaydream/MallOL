import AppForm from '../app-components/Form/AppForm';

Vue.component('product-form', {
    mixins: [AppForm],
    props: ['categories', 'brands'],
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
                category_id: null ,
                brand_id:  null ,

            },
            opt: {
                brand: null,
                category: null
            },
            mediaCollections: ['gallery']
        }
    },
    created () {
        if (this.data) {
            this.opt.brand = this.brands.find(b => b.id === this.data.brand_id)
            this.opt.category = this.categories.find(b => b.id === this.data.category_id)
        }
    },
    methods: {
        optChange () {
            this.form.category_id = this.opt.category.id
            this.form.brand_id = this.opt.brand.id
        }
    }

});
