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
    },
    {
        path: '/academicoffer',
        name: 'academicoffer',
        component: () => import('./views/AcademicOffers.vue')
    },
    {
        path: '/carousel',
        name: 'carousel',
        component: () => import('./views/Carousel.vue')
    },
    {
        path: '/contactus',
        name: 'contactus',
        component: () => import('./views/ContactUs.vue')
    },
    {
        path: '/questions',
        name: 'questions',
        component: () => import('./views/Questions.vue')
    },
    {
        path: '/salesianexperiencehome',
        name: 'salesianexperiencehome',
        component: () => import('./views/SalesianExperienceHome.vue')
    }
];

const router = new Router({
    routes: routes
});

export default router;
