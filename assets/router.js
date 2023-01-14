import {createRouter, createWebHashHistory} from "vue-router"
import DefaultLayout from './layouts/DefaultLayout'
import isObject from "@coreui/vue";
import auth from "./services/auth";

const routes = [
    {
        path: '/',
        name: 'Home',
        component: DefaultLayout,
        redirect: '/dashboard',
        children: [
            {
                path: '/dashboard',
                name: 'Dashboard',
                component: () => import(/* webpackChunkName: "dashboard" */ './pages/Dashboard.vue'),
            }
        ],
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/login',
        name: 'Login',
        component: () => import(/* webpackChunkName: "login" */ './ui/pages/Login.vue'),
        meta: {
            requiresAuth: false
        }
    },
    {
        path: '/logout',
        name: 'Logout',
        component: {
            beforeRouteEnter(to, from, next){
                auth.logout();
                return next('/login')
            }
        },
        meta: {
            requiresAuth: false
        }
    },
    {
        path: '/reset-password',
        name: 'ResetPassword',
        component: () => import(/* webpackChunkName: "login" */ './ui/pages/ResetPassword.vue'),
    }
]

const router = createRouter({
    history: createWebHashHistory('/'),
    routes,
    scrollBehavior() {
        // always scroll to top
        return { top: 0 }
    },
})

router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem('user');
    const publicPages = ['/login', '/logout', '/register', 'reset-password']
    const authRequired = !publicPages.includes(to.path);

    if(authRequired && !loggedIn){
        return next('/login')
    }
    next()
})

export default router