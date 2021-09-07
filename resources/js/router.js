    // Import Vue.
import Vue from 'vue';

    // Import Vue Router.
import Router from 'vue-router';

    // Import welcome page.
import Welcome from './views/Welcome.vue'

    // Declare use Vue router.
Vue.use(Router);


    // Declare routes.
const routes = [

        // Welcome page.
    {
        path: '/',
        name: 'welcome',
        component: Welcome
    },
    
        // Component AboutUs.
    {
        path: '/aboutus',
        name: 'aboutus',
        component: () => import('./views/AboutUs.vue')
    },

        // Component AcademicOffer.
    {
        path: '/academicoffer',
        name: 'academicoffer',
        component: () => import('./views/AcademicOffers.vue')
    },

        // Component Carousel.
    {
        path: '/carousel',
        name: 'carousel',
        component: () => import('./views/Carousel.vue')
    },

        // Component ContactUs.
    {
        path: '/contactus',
        name: 'contactus',
        component: () => import('./views/ContactUs.vue')
    },

        // Component Questions.
    {
        path: '/questions',
        name: 'questions',
        component: () => import('./views/Questions.vue')
    },

        // Component SalesianExperienceHome.
    {
        path: '/salesianexperiencehome',
        name: 'salesianexperiencehome',
        component: () => import('./views/SalesianExperienceHome.vue')
    },

        // Component NewHome.
    {
        path: '/newhome',
        name: 'newhome',
        component: () => import('./views/NewHome.vue')
    },

        // Component ServiceHome.
    {
        path: '/servicehome',
        name: 'servicehome',
        component: () => import('./views/ServiceHome.vue')
    },

        // Component StudentCouncil.
    {
        path: '/studentcouncil',
        name: 'studentcouncil',
        component: () => import('./views/StudentCouncil.vue')
    },

        // Component StudentCouncil.
    {
        path: '/commission',
        name: 'commission',
        component: () => import('./views/Commission.vue')
    }
];

    // Declare routes in router.
const router = new Router({
    routes: routes
});

    // Export router.
export default router;
