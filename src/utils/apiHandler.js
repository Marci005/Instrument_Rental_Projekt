import api from "./http";

const apiHandler = {
    async csrf() {
        /*
            Elég csak egyszer az app indításakor meghívni.
        */
        await api.get('/sanctum/csrf-cookie');
    },
    async me() {

    },
    async register(payload) {
        const { data } = await api.post('/api/register', payload);
        return data;
    },
    async login(payload) {
        const { data } = await api.post('/api/login', payload);
        return data;
    }
};

export default apiHandler;