/**
 * @file main.js
 * @description Application entry point.
 *
 * Imports Bootstrap JS so interactive widgets (dropdowns, collapses, modals)
 * initialise automatically. Imports Bootstrap CSS and Icons for styling.
 * Imports the project's own global stylesheet.
 * Creates the root Vue 3 app, registers Pinia (state management) and
 * Vue Router, then mounts the app into the #app div in index.html.
 */

import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'
import "bootstrap-icons/font/bootstrap-icons.css";
import './assets/app.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

/** Root Vue 3 application instance. */
const app = createApp(App)

/**
 * Register Pinia as the global store plugin.
 * Every defineStore() call becomes accessible app-wide after this line.
 */
app.use(createPinia())

/**
 * Register Vue Router.
 * Enables <RouterView />, <RouterLink />, useRouter() and useRoute() globally.
 */
app.use(router)

/**
 * Mount the application.
 * Replaces <div id="app"> in index.html with the rendered Vue component tree.
 */
app.mount('#app')
