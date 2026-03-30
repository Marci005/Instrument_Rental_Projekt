import { createRouter, createWebHistory } from 'vue-router'

import LoginView from "@/views/auth/LoginView.vue";
import RegisterView from "@/views/auth/RegisterView.vue";

import LendingView from "@/components/lending/LendingView.vue";

import AdminLendingListView from "@/views/app/LendingListView.vue";
import AdminLendingDetailsView from "@/views/app/LendingDetailsView.vue";
import AdminProfileView from "@/views/app//ProfileView.vue";
import AdminSettingsView from "@/views/app/SettingsView.vue";

const isNumeric = (n)=>/^\d+$/.test(n);
const isOrderId = (n) => /^ORD-\d{4}$/.test(n);
const PublicLayout=() => import("@/components/layouts/PublicLayout.vue");
const AuthLayout = () => import('@/components/layouts/AuthLayout.vue');
const AppLayout = () => import('@/components/layouts/AppLayout.vue');

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [


        {
            path: '/',
            component: PublicLayout,
            children: [
                {
                    path: '',
                    name: 'home',
                    component: () =>import("@/views/public/HomeView.vue"),
                    meta: { title: 'Kezdőlap' }
                },
                {
                    path: 'instruments',
                    name: 'instruments',
                    component: () =>import("@/views/public/InstrumentsView.vue"),
                    meta: { title: 'Hangszerek' }
                },
                {
                    path: 'instruments/:id',
                    name: 'instrument-details',
                    props: true,
                    component: () =>import("@/views/public/InstrumentDetailsView.vue"),
                    meta: { title: 'Részletek' }
                }
            ]
        },


        {
            path: '/auth',
            component: AuthLayout,
            children: [
                {
                    path: 'login',
                    name: 'login',
                    component: LoginView,
                    meta: { title: 'Bejelentkezés' }
                },
                {
                    path: 'register',
                    name: 'register',
                    component: RegisterView,
                    meta: { title: 'Regisztráció' }
                }
            ]
        },

        {
            path: '/app',
            component: AppLayout,
            meta: { requiresAuth: true },
            children: [
                {
                    path: 'lendings',
                    name: 'lendings',
                    component: LendingView,
                    meta: { title: 'Kölcsönzéseim' }
                }
            ]
        },

        {
            path: '/admin',
            component: AppLayout,
            meta: { requiresAuth: true, requiresAdmin: true },
            children: [
                {
                    path: 'lendings',
                    name: 'admin-lendings',
                    component: AdminLendingListView,
                    meta: { title: 'Kölcsönzések' }
                },
                {
                    path: 'lendings/:id',
                    name: 'admin-lending-details',
                    component: AdminLendingDetailsView,
                    props: true,
                    meta: { title: 'Kölcsönzés részletei' }
                },
                {
                    path: 'profile',
                    name: 'admin-profile',
                    component: AdminProfileView,
                    meta: { title: 'Profil' }
                },
                {
                    path: 'settings',
                    name: 'admin-settings',
                    component: AdminSettingsView,
                    meta: { title: 'Beállítások' }
                }
            ]
        },


        {
            path: '/:pathMatch(.*)*',
            name: 'not-found',
            component: () => import('@/views/errors/NotFoundView.vue'),
            meta: { title: 'Nincs ilyen oldal' }
        }
    ]
})


router.beforeEach((to, from, next) => {
    document.title = (to.meta.title || 'Oldal') + ' - Kölcsönző'

    const isLoggedIn = !!localStorage.getItem('token')
    const isAdmin = localStorage.getItem('role') === 'admin'

    if (to.meta.requiresAuth && !isLoggedIn) {
        return next({ name: 'login' })
    }

    if (to.meta.requiresAdmin && !isAdmin) {
        return next({ name: 'not-authorised' })
    }

    next()
})

export default router
