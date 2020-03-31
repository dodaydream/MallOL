/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vuex from 'vuex'
import store from './store'
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'
import VueCookie from 'vue-cookie';
import VModal from 'vue-js-modal'
import VeeValidate from 'vee-validate';
import Notifications from 'vue-notification';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('product', require('./components/Product.vue').default);
Vue.component('product-listing', require('./components/ProductListing.js').default);
Vue.component('cart-listing', require('./admin/cart/Listing.js').default);
Vue.component('order-listing', require('./admin/order/Listing.js').default);
Vue.component('order-form', require('./admin/order/Form.js').default);
Vue.component('order-item-listing', require('./admin/order-item/Listing.js').default);
Vue.component('cart', require('./components/Cart.vue').default);
Vue.component('order', require('./checkout.vue').default);
Vue.use(Buefy)
Vue.use(Vuex)
Vue.use(VueCookie)
Vue.use(VModal, { dialog: true, dynamic: true, injectModalsContainer: true });
Vue.use(VeeValidate, {strict: true});
Vue.use(Notifications);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import { mapActions } from 'vuex'

const app = new Vue({
    el: '#app',
    store,
    created () {
        this.retrieveCartItem()
    },
    methods: {
        ...mapActions('cart', [
            'retrieveCartItem'
        ])
    }
});
