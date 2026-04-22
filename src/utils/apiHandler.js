import api from "./http";

const apiHandler = {
    async csrf() {
        await api.get('/sanctum/csrf-cookie');
    },

    async login(payload) {
        await this.csrf();
        const { data } = await api.post('/api/login', payload);
        return data;
    },

    async register(payload) {
        await this.csrf();
        const { data } = await api.post('/api/register', payload);
        return data;
    },

    async logout() {
        await this.csrf();
        await api.post('/api/logout');
    },

    async me() {
        const { data } = await api.get('/api/me');
        return data;
    }
};

export default apiHandler;
