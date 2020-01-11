<template>
    <div>
<div class="columns">
    <div class="column">
        <b-carousel :indicator-inside="false">
            <b-carousel-item v-for="m in media" :key="m.id">
                <div class="image has-text-centered">
                  <img :src="m.url" style="height: 420px; width: auto; display: inline !important;">
                </div>
            </b-carousel-item>
            <template slot="indicators" slot-scope="props">
                <span class="al image">
                    <img :src="media[props.i].thumb" style="height: 80px !important"/>
                </span>
            </template>
        </b-carousel>
    </div>
    <div class="column">
        <h1 class="title">{{ product.name }}</h1>
        <h1 class="subtitle">{{ product.description }}</h1>

        <p v-if="product.market_price > product.price">MOP$ {{ product.market_price }}</p>
        <p v-if="product.is_promote"><del class="has-text-grey">MOP$ {{ product.price }}</del><span class="has-text-danger">&nbsp;MOP$ {{ product.promote_price }}</span></p>
        <p v-else>MOP$ {{ product.price }}</p>

        <section style="padding: 15px 0">
            <b-taglist>
                <b-tag v-for="inventory in product.inventories" :type="selectedAttr === inventory.id ? 'is-primary' : 'is-default'" @click.native="selectedAttr = inventory.id" size="is-medium">{{ inventory.product_attr }}</b-tag>
            </b-taglist>
        </section>
        
        <section>
            <b-button type="is-primary" outlined>Buy now</b-button>
            <b-button icon-left="cart-plus" type="is-primary" @click="addToCart" :disabled="selectedAttr === null">Add to Cart</b-button>
        </section>
    </div>

</div>
        <b-tabs position="is-centered" class="block">
            <b-tab-item label="Details">
                <div class="content" v-html="product.details"></div>
            </b-tab-item>
            <b-tab-item label="Comments">
                <article class="media">
  <figure class="media-left">
    <p class="image is-64x64">
      <img src="https://bulma.io/images/placeholders/128x128.png">
    </p>
  </figure>
  <div class="media-content">
    <div class="content">
      <p>
        <strong>John Smith</strong> <small>@johnsmith</small> <small>31m</small>
        <br>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare magna eros, eu pellentesque tortor vestibulum ut. Maecenas non massa sem. Etiam finibus odio quis feugiat facilisis.
      </p>
    </div>
  </div>
</article>
            </b-tab-item>
        </b-tabs>
    </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
    props: ['product', 'media'],
    data () {
        return {
            selectedAttr: null
        } 
    },
    methods: {
        ...mapActions('cart', [
            'addInventoryToCart'
        ]),
        addToCart () {
            if (this.selectedAttr) {
                const inventory = this.product.inventories.find(inv => inv.id ===this.selectedAttr)
    console.log(inventory)
                this.addInventoryToCart({
                    product: this.product,
                    inventory: inventory
                })
            }
        }
    }
}
</script>

<style scoped>
.is-active .al img {
    border: 2px solid #000;
}
.al img {
    border: 2px solid transparent;
}
</style>
