import Vue from 'vue';

import App from './App.vue'

import router from './router'

import BootstrapVue from 'bootstrap-vue';

import VueSweetalert2 from 'vue-sweetalert2';

Vue.use(BootstrapVue);

Vue.use(VueSweetalert2);

const app = new Vue({
    el: '#app',
    router,
    render: h => h(App)
});
