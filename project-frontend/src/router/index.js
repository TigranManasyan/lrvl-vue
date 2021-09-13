import Vue from 'vue';
import Router from 'vue-router';
import authRoutes from '@/components/auth/auth-routes';
import Profile from '@/components/Profile';
import MainPage from '@/components/MainPage';
import products from "../components/products/products";
Vue.use(Router);

export default new Router({
    mode: 'history',
    routes: [
        {path: '/', name: 'MainPage', component: MainPage},
        ...authRoutes,
        {path: '/profile', name: 'Profile', component: Profile},
        ...products
    ]
})
