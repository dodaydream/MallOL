import AppListing from '../app-components/Listing/AppListing';

var _lodash = require('lodash');

Vue.component('cart-listing', {
  mixins: [AppListing],
  methods: {
    checkout () {
      let itemsToCheckout = (0, _lodash.keys)((0, _lodash.pickBy)(this.bulkItems));

      var form = document.createElement('form');
      form.style.visibility = 'hidden';
      form.method = 'POST';
      form.action = '/checkout';
      var input = document.createElement('input');
      input.name = 'data';
      input.value = JSON.stringify(itemsToCheckout);

      var inputCsrf = document.createElement('input');
      // csrf protection
      inputCsrf.name = '_token';
      inputCsrf.value = $('meta[name="csrf-token"]').attr('content');
      form.appendChild(input)
      form.appendChild(inputCsrf)
      document.body.appendChild(form);
      form.submit();
    }
  }
});
