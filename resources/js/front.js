require('./vue-assets');

// start vuex

import Vuex from 'vuex'
Vue.use(Vuex)
import storeData from "./store/index"
const store = new Vuex.Store(
    storeData
)

// verification 

Vue.component('verification', require('./components/front/setting/Verification.vue').default);
Vue.component('cart', require('./components/front/cart/Cart.vue').default);
Vue.component('search-product', require('./components/front/product/SearchProduct.vue').default);
Vue.component('user-subscribe', require('./components/front/subscribe/Subscribe.vue').default);

var app = new Vue({

    el: '#front-wrapper',
    store
});