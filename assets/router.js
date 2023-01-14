import {createRouter, createWebHashHistory} from "vue-router"
import DefaultLayout from './ui/layouts/DefaultLayout'
import isObject from "@coreui/vue";
import auth from "./services/auth";

const sakramen = [
    {
        name: 'Baptis',
        path: '/baptis',
        component: () => import(/* webpackChunkName: "login" */ './ui/pages/UnderConstruction.vue'),
    },
    {
        name: 'Komuni',
        path: '/komuni',
        component: () => import(/* webpackChunkName: "login" */ './ui/pages/UnderConstruction.vue'),
    },
    {
        name: 'Krisma',
        path: '/krisma',
        component: () => import(/* webpackChunkName: "login" */ './ui/pages/UnderConstruction.vue'),
    },
    {
        name: 'Perkawinan',
        path: '/perkawinan',
        component: () => import(/* webpackChunkName: "login" */ './ui/pages/UnderConstruction.vue'),
    },
    {
        name: 'Perminyakan',
        path: '/perminyakan',
        component: () => import(/* webpackChunkName: "login" */ './ui/pages/UnderConstruction.vue'),
    }
];

const profile = [
    {
        name: "Profile",
        path: '/profile',
        redirect: "/profile/update-password",
        component: DefaultLayout,
        children: [
            {
                name: 'Update Password',
                path: '/profile/update-password',
                component: () => import(/* webpackChunkName: "login" */ './components/user/UpdatePassword'),
            },
        ]
    },
];
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
                component: () => import(/* webpackChunkName: "dashboard" */ './ui/pages/Dashboard.vue'),
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
    },
    {
        name: 'Sakramen',
        component: DefaultLayout,
        redirect: '/baptis',
        children: sakramen,
        path: '/sakramen'
    },
    ...profile
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