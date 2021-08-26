import Vue from 'vue';

import Router from 'vue-router';

import Welcome from './views/Welcome.vue'

Vue.use(Router);

const routes = [
    {
        path: '/',
        name: 'welcome',
        component: Welcome
    },
    {
        path: '/aboutus',
        name: 'aboutus',
        component: () => import('./views/AboutUs.vue')
    }
];

const router = new Router({
    routes: routes
});

export default router;
