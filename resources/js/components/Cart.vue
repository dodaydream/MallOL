<template>
    <div class="modal-card" style="width:350px;">
        <header class="modal-card-head">
            <p class="modal-card-title">Shopping Cart</p>
        </header>

        <section class="modal-card-body">
            <template v-if="products.length > 0">
                <article class="media" v-for="item in products" :key="item.id">
                  <figure class="media-left">
                    <p class="image is-64x64">
                      <img src="https://bulma.io/images/placeholders/64x64.png">
                    </p>
                  </figure>
                  <div class="media-content">
                    <div class="content">
                      <p>
                          <strong>{{ item.product.name }}</strong>
                          <br>
                          <small>Type: {{ item.inventory.product_attr }}</small>
                      </p>
                    </div>
                    <nav class="level is-mobile">
                        <b-numberinput size="is-small" 
                            :min="1"
                            :max="999"
                            controls-position="compact" 
                            :value="item.quantity"
                            @input="changeQty($event, item.id)">
                        </b-numberinput>
                    </nav>
                  </div>
                  <div class="media-right">
                    <small>x{{ item.quantity }}</small>
                  </div>
                </article>
            </template>
            <p v-else>No items</p>
        </section>

        <footer class="modal-card-foot">
            <a class="button" href="/carts">View Bag</a>
            <b-button @click="checkout" type="is-primary">Go to Checkout</b-button>
        </footer>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
export default {
    computed: {
        ...mapGetters('cart', {
            products: 'cartProducts',
            totalPrice: 'cartTotalPrice'
        })
    },
    methods: {
        ...mapActions('cart', [
            'changeQuantity'
        ]),
        changeQty (value, id) {
            this.changeQuantity({ id: id, qty: value })
        },
        checkout () {
        // TODO
        }
    }
}
</script>

<style scoped>
img {
    max-height: initial;
}
</style>
