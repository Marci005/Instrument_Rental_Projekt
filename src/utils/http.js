/**
 * @file http.js
 * @description Pre-configured Axios instance used by every API call.
 *
 * baseURL         - All requests target the Laravel dev server on port 8000.
 * withCredentials - Sends the session cookie on every request; required for
 *                   Laravel Sanctum cookie-based authentication.
 * withXSRFToken   - Axios reads the XSRF-TOKEN cookie set by Laravel and
 *                   attaches it as X-XSRF-TOKEN automatically, preventing CSRF.
 * Accept          - Forces Laravel to return JSON on 401/422/403 instead of
 *                   HTML redirect pages, which the SPA can handle correctly.
 * Content-Type    - Default for JSON bodies; overridden to multipart/form-data
 *                   by apiHandler.post() when a FormData payload is passed.
 * X-Requested-With - Marks the request as AJAX so Laravel skips browser
 *                    redirects on authentication failures.
 */

import axios from 'axios'

/** Shared Axios instance. Import this instead of raw axios everywhere. */
const api = axios.create({
    baseURL: 'http://localhost:8000',
    withCredentials: true,
    withXSRFToken: true,
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    }
});

export default api;
