/**
 * @file router/index.js
 * @description Vue Router configuration for the Instrument Rental SPA.
 *
 * Route groups:
 *   /         → PublicLayout  (unauthenticated visitors)
 *   /auth/*   → AuthLayout   (guest-only: login, register)
 *   /app/*    → AppLayout    (requiresAuth; admins are redirected to /admin)
 *   /admin/*  → AdminLayout  (requiresAuth + requiresAdmin)
 *   /*        → NotFoundView (catch-all 404)
 *
 * A single beforeEach guard handles all access control logic.
 */

import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '../utils/authStore'

// Auth views
import LoginView from "@/views/auth/LoginView.vue";
import RegisterView from "@/views/auth/RegisterView.vue";

// Public views
import HomeView from "@/views/public/HomeView.vue";
import InstrumentsView from "@/views/public/InstrumentsView.vue";

// App views
import InstrumentDetailsView from "@/views/public/InstrumentDetailsView.vue";
import AppLendingView from "@/components/lending/LendingView.vue";

// Admin views
import AdminUserView from "@/views/app/admin/AdminUserView.vue";
import AdminUserRentsView from "@/views/app/admin/AdminUserRentsView.vue";
import InstrumentFormView from "@/views/app/admin/InstrumentFormView.vue";

/**
 * Layouts are lazy-loaded (dynamic import) where they are not on the
 * critical first-load path, so their JS chunk is only fetched when needed.
 */
const PublicLayout = () => import("@/components/layouts/PublicLayout.vue");
const AuthLayout   = () => import('@/components/layouts/AuthLayout.vue');
const AppLayout    = () => import('@/components/layouts/AppLayout.vue');
/** AdminLayout is eagerly imported because admins land here right after login. */
import AdminLayout from "@/components/layouts/AdminLayout.vue";

const router = createRouter({
    /** HTML5 History API — clean URLs without the # fragment. */
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [

        // ── PUBLIC ────────────────────────────────────────────────────────────
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
                /**
                 * Redirect /instruments/:id → app-instrument-details.
                 * Visitors who arrive on the public URL are sent to the
                 * authenticated version that shows the LendingForm.
                 */
                {
                    path: 'instruments/:id',
                    redirect: (to) => {
                        return { name: 'app-instrument-details', params: to.params }
                    }
                }
            ]
        },

        // ── AUTH (guest-only) ─────────────────────────────────────────────────
        {
            path: '/auth',
            component: AuthLayout,
            /** meta.guest: the guard redirects logged-in users away from here. */
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

        // ── APP (authenticated users) ─────────────────────────────────────────
        {
            path: '/app',
            component: AppLayout,
            /** meta.requiresAuth: unauthenticated users are sent to /auth/login. */
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
                    /**
                     * props: true — the :id route param is injected directly
                     * as a component prop, avoiding manual useRoute() calls.
                     */
                    props: true,
                    component: InstrumentDetailsView
                },
                {
                    path: 'lendings',
                    name: 'lendings',
                    component: AppLendingView,
                    meta: { title: 'Kölcsönzéseim' }
                }
            ]
        },

        // ── ADMIN ─────────────────────────────────────────────────────────────
        {
            path: '/admin',
            component: AdminLayout,
            /** Both flags must be true — only logged-in admins reach this section. */
            meta: { requiresAuth: true, requiresAdmin: true },
            children: [
                {
                    path: 'users',
                    name: 'admin-users',
                    component: AdminUserView,
                    meta: { title: 'Felhasználók' }
                },
                {
                    path: 'users/:id/rents',
                    name: 'admin-user-rents',
                    component: AdminUserRentsView,
                    props: true,
                    meta: { title: 'Felhasználó kölcsönzései' }
                },
                {
                    path: 'instruments/new',
                    name: 'admin-instrument-new',
                    component: InstrumentFormView,
                    meta: { title: 'Hangszer felvitel' }
                }
            ]
        },

        // ── 404 CATCH-ALL ─────────────────────────────────────────────────────
        {
            /** Matches every path not matched by the routes above. */
            path: '/:pathMatch(.*)*',
            name: 'not-found',
            component: () => import('@/views/errors/NotFoundView.vue'),
            meta: { title: 'Nincs ilyen oldal' }
        }
    ]
})


/**
 * Global navigation guard — runs before every route change.
 *
 * Check order:
 *  1. Route requires auth but store has no user → try fetching (handles page refresh).
 *  2. Route requires admin but user is not admin → redirect to app-home.
 *  3. Admin tries to visit /app/* → redirect to admin-users.
 *  4. Route requires auth but user is still not logged in → redirect to login.
 *  5. Guest-only route but user is logged in → redirect to appropriate home.
 *  6. Everything OK → return true (allow navigation).
 *
 * @param {import('vue-router').RouteLocationNormalized} to
 * @param {import('vue-router').RouteLocationNormalized} from
 */
router.beforeEach(async (to, from) => {
    const auth = useAuthStore();

    /** Step 1: re-hydrate Pinia after a page refresh. */
    if (to.meta.requiresAuth && !auth.user) {
        try {
            await auth.fetchUser();
        } catch {}
    }

    const isLoggedIn = !!auth.user;
    const isAdmin    = auth.user?.is_admin === 1;

    /** Step 2: non-admins cannot access admin routes. */
    if (to.meta.requiresAdmin && !isAdmin) {
        return { name: 'app-home' };
    }

    /** Step 3: admins should not use the regular /app area. */
    if (isAdmin && to.path.startsWith('/app')) {
        return { name: 'admin-users' };
    }

    /** Step 4: unauthenticated access to protected routes → login. */
    if (to.meta.requiresAuth && !isLoggedIn) {
        return { name: 'login' };
    }

    /** Step 5: already logged-in users away from guest-only pages. */
    if (to.meta.guest && isLoggedIn) {
        return isAdmin
            ? { name: 'admin-users' }
            : { name: 'app-home' };
    }

    return true;
});

export default router;
