import { createRouter, createWebHistory } from 'vue-router';
import LandingPage from '../pages/LandingPage.vue';
import CheckoutPage from '../pages/CheckoutPage.vue';
import ThankYouPage from '../pages/ThankYouPage.vue';

const routes = [
    {
        path: '/',
        name: 'landing',
        component: LandingPage,
    },
    {
        path: '/checkout',
        name: 'checkout',
        component: CheckoutPage,
    },
    {
        path: '/thank-you/:orderNumber',
        name: 'thank-you',
        component: ThankYouPage,
        props: true,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;