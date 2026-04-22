import { defineStore } from "pinia";
import { computed, ref } from "vue";
import apiHandler from "./apiHandler";
import router from "@/router";

export const useAuthStore = defineStore('auth', () => {

    const user = ref(null);
    const loading = ref(false);
    const errors = ref({});

    const isAuthenticated = computed(() => !!user.value);
    const isAdmin = computed(() => user.value?.is_admin === 1);

    async function login(payload) {
        loading.value = true;
        errors.value = {};

        try {
            await apiHandler.login(payload);
            user.value = await apiHandler.me();

            // 🔥 ADMIN AUTOMATIKUS ÁTIRÁNYÍTÁS
            if (user.value?.is_admin === 1) {
                router.push("/admin/users");
            } else {
                router.push("/app/home");
            }

        } catch (err) {
            errors.value = err.response?.data?.errors ?? {};
        } finally {
            loading.value = false;
        }
    }

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

    async function fetchUser() {
        try {
            user.value = await apiHandler.me();
        } catch {
            user.value = null;
        }
    }

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
