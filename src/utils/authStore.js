import { defineStore } from "pinia";
import { computed, ref } from "vue";
import apiHandler from "./apiHandler";

/*
    Composable függvény: sima függvény reaktív elemekkel.
*/
export const useAuthStore = defineStore('auth', ()=> {
    /*
        User adatok tárolása.
    */
    const user = ref(null);
    const loading = ref(false);
    const errors = ref({});

    /*
        Be van-e jelentkezve a felhasználó vagy sem.
    */
    const isAuthenticated = computed(()=>!!user.value);
    const isAdmin = computed(()=>user.value?.is_admin === true);

    async function login(payload) {
        /*
            elkezdünk loadingolni
        */
        loading.value = true;

        errors.value = {};

        try {
            const data = await apiHandler.login(payload);
            user.value = data.user;
        } catch(err) {
            errors.value = err.response?.errors ?? {};
            //errors.value = err.response?.errors ? err.response?.errors : {};
        } finally {
            loading.value = false;
        }
    }

    async function register(payload) {
        loading.value = true;
        errors.value = {};

        try {
            const data = await apiHandler.register(payload);
            user.value = data.user;
        } catch(err) {
            errors.value = err.response?.errors ?? {};
        } finally {
            loading.value = false;
        }
    }

    return {
        user, loading,
        errors, login,
        register
    }
});