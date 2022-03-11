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
Vue.component('profile-update', require('./components/front/profile/ProfileUpdate.vue').default);
Vue.component('order-history', require('./components/front/user/Orders.vue').default);

import VueLazyload from 'vue-lazyload';

Vue.use(VueLazyload, {

    loading: base_url + 'images/loading.gif',

});

var app = new Vue({

    el: '#front-wrapper',
    store
});