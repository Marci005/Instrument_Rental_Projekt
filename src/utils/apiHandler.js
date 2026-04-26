/**
 * @file apiHandler.js
 * @description Centralised API helper that wraps the shared Axios instance.
 *
 * Every state-mutating method calls csrf() first. Laravel Sanctum requires
 * the XSRF-TOKEN cookie to be present before any POST/PUT/PATCH/DELETE so
 * Axios can attach it as X-XSRF-TOKEN automatically (withXSRFToken in http.js).
 *
 * Usage:
 *   import apiHandler from '@/utils/apiHandler';
 *   const { data } = await apiHandler.get('/api/instruments');
 */

import api from "./http";

const apiHandler = {

    /**
     * Fetches the CSRF cookie from Laravel Sanctum (/sanctum/csrf-cookie).
     * Laravel sets XSRF-TOKEN in the response; Axios reads it on the next
     * mutating request automatically. Must be called before every mutation.
     */
    async csrf() {
        await api.get('/sanctum/csrf-cookie');
    },

    /**
     * Logs in a user via Sanctum session authentication.
     * @param {{ email: string, password: string }} payload
     * @returns {Promise<Object>} Response data from /api/login.
     */
    async login(payload) {
        await this.csrf();
        const { data } = await api.post('/api/login', payload);
        return data;
    },

    /**
     * Registers a new user account.
     * @param {Object} payload  Registration fields (email, password, name…).
     * @returns {Promise<Object>} Response data from /api/register.
     */
    async register(payload) {
        await this.csrf();
        const { data } = await api.post('/api/register', payload);
        return data;
    },

    /**
     * Logs out the current user and invalidates the server-side session.
     */
    async logout() {
        await this.csrf();
        await api.post('/api/logout');
    },

    /**
     * Returns the currently authenticated user's profile from /api/me.
     * @returns {Promise<Object>} The user object.
     */
    async me() {
        const { data } = await api.get('/api/me');
        return data;
    },

    /**
     * Generic GET — returns the full Axios response object.
     * @param {string} url          Endpoint path relative to baseURL.
     * @param {Object} [config={}]  Optional Axios config overrides.
     * @returns {Promise<import('axios').AxiosResponse>}
     */
    async get(url, config = {}) {
        return await api.get(url, config);
    },

    /**
     * Generic POST. Fetches CSRF first.
     * If payload is a FormData instance (file upload) the Content-Type is
     * overridden to multipart/form-data so the server receives the file.
     * @param {string}          url
     * @param {Object|FormData} [payload={}]
     * @param {Object}          [config={}]
     * @returns {Promise<import('axios').AxiosResponse>}
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
     * Generic PUT. Fetches CSRF first.
     * @param {string} url
     * @param {Object} [payload={}]
     * @param {Object} [config={}]
     * @returns {Promise<import('axios').AxiosResponse>}
     */
    async put(url, payload = {}, config = {}) {
        await this.csrf();
        return await api.put(url, payload, config);
    },

    /**
     * Generic PATCH. Fetches CSRF first.
     * @param {string} url
     * @param {Object} [payload={}]
     * @param {Object} [config={}]
     * @returns {Promise<import('axios').AxiosResponse>}
     */
    async patch(url, payload = {}, config = {}) {
        await this.csrf();
        return await api.patch(url, payload, config);
    },

    /**
     * Generic DELETE. Fetches CSRF first.
     * @param {string} url
     * @param {Object} [config={}]
     * @returns {Promise<import('axios').AxiosResponse>}
     */
    async delete(url, config = {}) {
        await this.csrf();
        return await api.delete(url, config);
    },
};

export default apiHandler;
