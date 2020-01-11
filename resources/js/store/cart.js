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

  changeQuantity({ state, commit }, { inventoryId, qty }) {
    const cartItem = state.items.find(item => item.id === inventoryId)

    console.log(cartItem)

    if (cartItem) {
      commit('setItemQuantity', {
        id: cartItem.id,
        qty: qty
      })
    }
  },

  addInventoryToCart({ state, commit }, { product, inventory }) {
    console.log(inventory)
    commit('setCheckoutStatus', null)
    if (inventory.qty > 0) {
      const cartItem = state.items.find(item => item.id === inventory.id)
      if (!cartItem) {
        commit('pushInventoryToCart', {
            id: inventory.id,
            product: product,
            inventory: inventory
        })
      } else {
        commit('incrementItemQuantity', cartItem)
      }
    }
  }
}

// mutations
const mutations = {
  pushInventoryToCart (state, { id, product, inventory }) {
    state.items.push({
      id,
      product,
      inventory,
      quantity: 1
    })
  },

  incrementItemQuantity (state, { id }) {
    const cartItem = state.items.find(item => item.id === id)
    cartItem.quantity++
  },

  setItemQuantity (state, { id, qty }) {
    const cartItem = state.items.find(item => item.id === id)
    cartItem.quantity = qty
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
