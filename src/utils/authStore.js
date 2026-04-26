/**
 * @file authStore.js
 * @description Pinia authentication store (Composition API / setup-store style).
 *
 * State:
 *   user    — the logged-in user object, or null when unauthenticated.
 *   loading — true while any async auth operation is running.
 *   errors  — Laravel validation error bag { fieldName: string[] }.
 *
 * Computed:
 *   isAuthenticated — true when user !== null.
 *   isAdmin         — true when user.is_admin === 1.
 *
 * Actions:
 *   login()      — authenticates and redirects by role (admin/normal).
 *   register()   — creates account, auto-logs in, redirects to /app/home.
 *   fetchUser()  — re-hydrates the store from the session (used by router guard).
 *   logout()     — invalidates session, clears state, redirects to public home.
 */

import { defineStore } from "pinia";
import { computed, ref } from "vue";
import apiHandler from "./apiHandler";
import router from "@/router";

export const useAuthStore = defineStore('auth', () => {

    /** @type {import('vue').Ref<Object|null>} Authenticated user or null. */
    const user = ref(null);

    /** True while an async auth call is in progress. Used to disable buttons. */
    const loading = ref(false);

    /** Laravel validation errors keyed by field name. Empty object when no errors. */
    const errors = ref({});

    /** True when a user is currently logged in. */
    const isAuthenticated = computed(() => !!user.value);

    /**
     * True when the logged-in user has admin privileges.
     * Optional chaining makes this safely return false when user is null.
     */
    const isAdmin = computed(() => user.value?.is_admin === 1);

    /**
     * Logs in with email + password credentials.
     * On success: fetches full user profile then redirects:
     *   admin  → /admin/users
     *   normal → /app/home
     * On failure: populates errors with Laravel's field validation messages.
     *
     * @param {{ email: string, password: string }} payload
     */
    async function login(payload) {
        loading.value = true;
        errors.value = {};

        try {
            await apiHandler.login(payload);
            user.value = await apiHandler.me();

            if (user.value?.is_admin === 1) {
                router.push("/admin/users");
            } else {
                router.push("/app/home");
            }

        } catch (err) {
            /** Fallback to {} if the response body has no errors key. */
            errors.value = err.response?.data?.errors ?? {};
        } finally {
            loading.value = false;
        }
    }

    /**
     * Registers a new user then immediately logs them in.
     * Fetches the user profile after registration and redirects to /app/home.
     *
     * @param {Object} payload  Registration fields (email, password, name, title…).
     */
    async function register(payload) {
        loading.value = true;
        errors.value = {};

        try {
            await apiHandler.register(payload);
            user.value = await apiHandler.me();
            router.push("/app/home");
        } catch (err) {
            errors.value = err.response?.data?.errors ?? {};
        } finally {
            loading.value = false;
        }
    }

    /**
     * Fetches the current user's profile from the backend.
     * Called by the router beforeEach guard on protected routes after a page
     * refresh — Pinia lives in memory, so the state is lost on reload.
     * Silently sets user to null on failure (unauthenticated / session expired).
     */
    async function fetchUser() {
        try {
            user.value = await apiHandler.me();
        } catch {
            user.value = null;
        }
    }

    /**
     * Logs out the current user.
     * The catch block is empty intentionally: even if the backend call fails
     * (e.g. network error), we clear local state so the UI stays consistent.
     */
    async function logout() {
        try {
            await apiHandler.logout();
        } catch {}
        user.value = null;
        router.push("/");
    }

    return {
        user,
        loading,
        errors,
        isAuthenticated,
        isAdmin,
        login,
        register,
        fetchUser,
        logout
    };
});
