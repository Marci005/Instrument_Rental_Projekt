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
    },

    /**
     * Generic GET request. Returns the full Axios response (with `data`, `status`...).
     */
    async get(url, config = {}) {
        return await api.get(url, config);
    },

    /**
     * Generic POST request. Automatically fetches CSRF cookie before calling.
     * When the payload is a FormData instance, it is sent as multipart/form-data.
     */
    async post(url, payload = {}, config = {}) {
        await this.csrf();

        if (payload instanceof FormData) {
            return await api.post(url, payload, {
                ...config,
                headers: {
                    ...(config.headers || {}),
                    'Content-Type': 'multipart/form-data',
                },
            });
        }

        return await api.post(url, payload, config);
    },

    /**
     * Generic PUT request.
     */
    async put(url, payload = {}, config = {}) {
        await this.csrf();
        return await api.put(url, payload, config);
    },

    /**
     * Generic PATCH request.
     */
    async patch(url, payload = {}, config = {}) {
        await this.csrf();
        return await api.patch(url, payload, config);
    },

    /**
     * Generic DELETE request.
     */
    async delete(url, config = {}) {
        await this.csrf();
        return await api.delete(url, config);
    },
};

export default apiHandler;
