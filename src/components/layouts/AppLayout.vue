<!--
  @file AppLayout.vue
  @description Layout shell for authenticated regular-user pages (/app/*).

  Renders a Bootstrap dark navbar with:
    - Brand link to the public home
    - Nav links: Home, Instruments, My Rentals
    - Logout button (red) that calls auth.logout() from the Pinia store

  The <RouterView /> below the navbar renders the current /app/* child route.

  Access control (requiresAuth) is enforced by the router guard — this
  layout does not re-check auth itself. Admins are automatically redirected
  away from /app/* by the beforeEach guard in router/index.js.
-->
<script>
import { useAuthStore } from "@/utils/authStore";
import { RouterLink, RouterView, useRouter } from "vue-router";

export default {
  name:"AppLayout",
  setup() {
    const auth   = useAuthStore();
    const router = useRouter();

    /**
     * Logs out the user via the Pinia auth store (which clears the user ref
     * and calls the backend logout endpoint), then redirects to the public home.
     * The store's logout() already calls router.push('/'), but the explicit push
     * here acts as a defensive fallback.
     */
    async function logout() {
      await auth.logout();
      router.push('/');
    }

    return { logout };
  }
};
</script>

<template>
  <div>
    <!-- Bootstrap dark navbar for authenticated regular users -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">

        <!-- Brand — navigates to the public landing page -->
        <RouterLink class="navbar-brand" to="/">Kölcsönző</RouterLink>

        <!-- Mobile hamburger toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">

          <!-- Left-aligned navigation links for authenticated users -->
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <RouterLink class="nav-link" to="/app/home">Kezdőlap</RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink class="nav-link" to="/app/instruments">Hangszerek</RouterLink>
            </li>
            <li class="nav-item">
              <!-- Link to the user's active rental list -->
              <RouterLink class="nav-link" to="/app/lendings">Kölcsönzéseim</RouterLink>
            </li>
          </ul>

          <!-- Right-aligned logout button -->
          <div class="d-flex gap-2">
            <button class="btn btn-danger btn-sm" @click="logout">Kijelentkezés</button>
          </div>

        </div>
      </div>
    </nav>

    <!-- Renders whichever /app/* child route is currently active -->
    <RouterView />
  </div>
</template>
