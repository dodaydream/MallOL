<template>
    <div>
    <slot></slot>
    <b-button type="is-primary" @click="putOrder">Order now</b-button>
    </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  props: [ 'ids' ],
  methods: {
    putOrder () {
      let itemsToCheckout = this.ids;

      var form = document.createElement('form');
      form.style.visibility = 'hidden';
      form.method = 'POST';
      form.action = '/checkout_success';
      var input = document.createElement('input');
      input.name = 'ids';
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
};
</script>
