// initial state
// shape: [{ id, quantity }]
const state = {
  items: [],
  checkoutStatus: null
}

const shop = {}

// getters
const getters = {
  cartProducts: (state, getters, rootState) => {
    return state.items
  },

  cartTotalPrice: (state, getters) => {
    return getters.cartProducts.reduce((total, item) => {
      return total + item.product.price * item.quantity
    }, 0)
  }
}

// actions
const actions = {
  retrieveCartItem ({ commit, state }) {
    // FIXME: this workaround may not be perfect
    window.axios.get('http://0.0.0.0:3000/carts?per_page=1000&page=1&orderBy=id&orderDirection=asc').then(({data}) => {
      data.data.data.forEach(item => {
          commit('pushInventoryToCart', {
              id: item.id,
              product: item.inventory.product,
              inventory: item.inventory,
              qty: item.qty
          })
      })
    })
  },
  checkout ({ commit, state }, products) {
    const savedCartItems = [...state.items]
    commit('setCheckoutStatus', null)
    // empty cart
    commit('setCartItems', { items: [] })
    shop.buyProducts(
      products,
      () => commit('setCheckoutStatus', 'successful'),
      () => {
        commit('setCheckoutStatus', 'failed')
        // rollback to the cart saved before sending the request
        commit('setCartItems', { items: savedCartItems })
      }
    )
  },

  changeQuantity({ state, commit }, { id, qty }) {
    const cartItem = state.items.find(item => item.id === id)

    console.log(cartItem)

    if (cartItem) {
      window.axios.post(`/carts/${cartItem.id}`, {
        qty: qty
      }).then(({data}) => {
        commit('setItemQuantity', {
          id: cartItem.id,
          qty: qty
        })
      })
    }
  },

  addInventoryToCart({ state, commit }, { product, inventory }) {
    console.log(inventory)
    commit('setCheckoutStatus', null)


    if (inventory.qty > 0) {
      const cartItem = state.items.find(item => item.inventory.id === inventory.id)
      if (!cartItem) {
        window.axios.post('/carts', {
          sku: inventory.sku,
          inventory_id: inventory.id,
          qty: 1
        }).then(({data}) => {
          commit('pushInventoryToCart', {
              id: data.id,
              product: data.product,
              inventory: data.inventory,
              qty: data.qty
          })
        }).catch(e => {
          if (e.response.status === 401) {
            window.location.href = `/login?redirect_to=${window.location.pathname}`;
          }
        })
      } else {
        window.axios.post(`/carts/${cartItem.id}`, {
          qty: cartItem.quantity + 1
        }).then(({data}) => {
          commit('incrementItemQuantity', cartItem)
        })
      }
    }
  }
}

// mutations
const mutations = {
  pushInventoryToCart (state, { id, product, inventory, qty }) {
    state.items.push({
      id,
      product,
      inventory,
      quantity: qty
    })
  },

  incrementItemQuantity (state, { id }) {
    const cartItem = state.items.find(item => item.id === id)
    cartItem.quantity++
  },

  setItemQuantity (state, { id, qty }) {
    const index = state.items.findIndex(item => item.id === id)
    const newItem = Object.assign({}, state.items[index])
    newItem.quantity = qty
    state.items.splice(index, 1, newItem)
  },

  setCartItems (state, { items }) {
    state.items = items
  },

  setCheckoutStatus (state, status) {
    state.checkoutStatus = status
  }
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
