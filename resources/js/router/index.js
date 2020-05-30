import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import auth from '../middleware/auth'

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/recipes/:id',
            name: 'recipeSingle',
            // route level code-splitting
            // this generates a separate chunk (recipe-single.[hash].js) for this route
            // which is lazy-loaded when the route is visited.
            component: () => import(/* webpackChunkName: "js/chunks/recipe-single" */ '../views/recipes/Single.vue')
        },
        {
            path: '/about',
            name: 'about',
            // route level code-splitting
            // this generates a separate chunk (about.[hash].js) for this route
            // which is lazy-loaded when the route is visited.
            component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
        },
        {
            path: '/settings',
            name: 'settings',
            meta: { requiresAuth: true },
            // route level code-splitting
            // this generates a separate chunk (settings.[hash].js) for this route
            // which is lazy-loaded when the route is visited.
            component: () => import(/* webpackChunkName: "settings" */ '../views/Settings.vue')
        },
        {
            path: '/login',
            name: 'login',
            // route level code-splitting
            // this generates a separate chunk (login.[hash].js) for this route
            // which is lazy-loaded when the route is visited.
            component: () => import(/* webpackChunkName: "login" */ '../views/auth/Login.vue')
        },
        {
            path: '/register',
            name: 'register',
            // route level code-splitting
            // this generates a separate chunk (register.[hash].js) for this route
            // which is lazy-loaded when the route is visited.
            component: () => import(/* webpackChunkName: "register" */ '../views/auth/Register.vue')
        },
        {
            path: '*',
            name: 'pageNotFound',
            // route level code-splitting
            // this generates a separate chunk (page-not-found.[hash].js) for this route
            // which is lazy-loaded when the route is visited.
            component: () => import(/* webpackChunkName: "page-not-found" */ '../views/PageNotFound.vue')
        },
    ]
});

router.beforeEach(auth);

export default router;
