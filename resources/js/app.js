import Vue from 'vue';

import App from './App.vue'

import router from './router'

import store from './store';

import BootstrapVue from 'bootstrap-vue';

import VueSweetalert2 from 'vue-sweetalert2';

import 'sweetalert2/dist/sweetalert2.min.css';

Vue.use(VueSweetalert2);

Vue.use(BootstrapVue);

const app = new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App)
});

const opts = {}

export default new Vuetify(opts)