import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '../utils/authStore'

// Auth views
import LoginView from "@/views/auth/LoginView.vue";
import RegisterView from "@/views/auth/RegisterView.vue";

// Public views
import HomeView from "@/views/public/HomeView.vue";
import InstrumentsView from "@/views/public/InstrumentsView.vue";
import InstrumentDetailsView from "@/views/public/InstrumentDetailsView.vue";


import AppLendingView from "@/components/lending/LendingView.vue";

// Admin views
import AdminLendingListView from "@/views/app/LendingListView.vue";
import AdminLendingDetailsView from "@/views/app/LendingDetailsView.vue";
import AdminProfileView from "@/views/app/ProfileView.vue";
import AdminSettingsView from "@/views/app/SettingsView.vue";
import AdminUserView from "@/views/app/admin/AdminUserView.vue";

// Layouts
const PublicLayout = () => import("@/components/layouts/PublicLayout.vue");
const AuthLayout = () => import('@/components/layouts/AuthLayout.vue');
const AppLayout = () => import('@/components/layouts/AppLayout.vue');

import AdminLayout from "@/components/layouts/AdminLayout.vue";

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
                    component: HomeView,
                    meta: { title: 'Kezdőlap' }
                },
                {
                    path: 'instruments',
                    name: 'instruments',
                    component: InstrumentsView,
                    meta: { title: 'Hangszerek' }
                },
                {
                    path: 'instruments/:id',
                    name: 'instrument-details',
                    props: true,
                    component: InstrumentDetailsView,
                    meta: { title: 'Részletek' }
                }
            ]
        },

        {
            path: '/auth',
            component: AuthLayout,
            meta: { guest: true },
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
                    path: 'home',
                    name: 'app-home',
                    component: HomeView
                },
                {
                    path: 'instruments',
                    name: 'app-instruments',
                    component: InstrumentsView
                },
                {
                    path: 'instruments/:id',
                    name: 'app-instrument-details',
                    props: true,
                    component: () => import("@/views/public/InstrumentDetailsView.vue")
                },
                {
                    path: 'lendings',
                    name: 'lendings',
                    component: AppLendingView,
                    meta: { title: 'Kölcsönzéseim' }
                }
            ]
        },

        {
            path: '/admin',
            component: AdminLayout,
            meta: { requiresAuth: true, requiresAdmin: true },
            children: [
                {
                    path: 'users',
                    name: 'admin-users',
                    component: AdminUserView,
                    meta: { title: 'Felhasználók' }
                },
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

        // 404
        {
            path: '/:pathMatch(.*)*',
            name: 'not-found',
            component: () => import('@/views/errors/NotFoundView.vue'),
            meta: { title: 'Nincs ilyen oldal' }
        }
    ]
})


router.beforeEach(async (to, from) => {
    const auth = useAuthStore();

    if (to.meta.requiresAuth && !auth.user) {
        try {
            await auth.fetchUser();
        } catch {}
    }

    const isLoggedIn = !!auth.user;
    const isAdmin = auth.user?.is_admin === 1;

    if (to.meta.requiresAdmin && !isAdmin) {
        return { name: 'app-home' };
    }

    if (isAdmin && to.path.startsWith('/app')) {
        return { name: 'admin-users' };
    }

    if (to.meta.requiresAuth && !isLoggedIn) {
        return { name: 'login' };
    }

    if (to.meta.guest && isLoggedIn) {
        return isAdmin
            ? { name: 'admin-users' }
            : { name: 'app-home' };
    }

    return true;
});



export default router;