import './bootstrap';

import 'vue-multiselect/dist/vue-multiselect.min.css';
import flatPickr from 'vue-flatpickr-component';
import VueQuillEditor from 'vue-quill-editor';
import Notifications from 'vue-notification';
import Multiselect from 'vue-multiselect';
import VeeValidate from 'vee-validate';
import 'flatpickr/dist/flatpickr.css';
import VueCookie from 'vue-cookie';
import { Admin } from 'craftable';
import VModal from 'vue-js-modal'
import Vue from 'vue';

import './app-components/bootstrap';
import './index';

import 'craftable/dist/ui';

Vue.component('multiselect', Multiselect);
Vue.use(VeeValidate, {strict: true});
Vue.component('datetime', flatPickr);
Vue.use(VModal, { dialog: true, dynamic: true, injectModalsContainer: true });
Vue.use(VueQuillEditor);
Vue.use(Notifications);
Vue.use(VueCookie);

new Vue({
    mixins: [Admin],
    data () {
        return {
            date: null
        }
    },
    created () {
        if (!window.location.search) {
            const end = new Date();
            const start = new Date();
            start.setDate(end.getDate() - 30);

            this.date = start.toISOString().slice(0, 10) + ' to ' + end.toISOString().slice(0, 10);
        } else {
            this.date = unescape(window.location.search).slice(7);
        }
    },
    methods: {
        changeDateFilter () {
            window.location.href = '/admin/?range=' + this.date
        }
    }
});