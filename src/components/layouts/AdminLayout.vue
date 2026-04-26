<!--
  @file AdminLayout.vue
  @description Layout shell for admin pages (/admin/*).

  Renders a Bootstrap dark navbar with admin-specific links:
    - Brand "Admin Panel" → /admin/users
    - Nav links: User Management, Add Instrument
    - Logout button (neutral grey styling, not red — red is reserved for
      destructive data actions like "Delete user" on the child pages)

  <main class="admin-content"> renders the active /admin/* child route.

  Access control (requiresAuth + requiresAdmin) is enforced by the router
  guard; this layout does not re-check authentication itself.
-->
<script>
import {useAuthStore} from "@/utils/authStore.js";
import {useRouter} from "vue-router";

export default {
  name: "AdminLayout",
  setup() {
    const auth   = useAuthStore();
    const router = useRouter();

    /**
     * Logs out the admin via the Pinia store, then redirects to public home.
     * The store already calls router.push('/') internally, but the explicit
     * call here is a safety net.
     */
    async function logout() {
      await auth.logout();
      router.push('/');
    }

    return { logout };
  }
}
</script>

<template>
  <!-- Full-height flex-column wrapper -->
  <div class="admin-layout">

    <!-- Admin navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
      <div class="container-fluid">

        <!-- Brand — links to the main admin landing page (user list) -->
        <RouterLink class="navbar-brand" to="/admin/users">
          Admin Panel
        </RouterLink>

        <!-- Mobile hamburger toggle -->
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#adminNav"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="adminNav">

          <!-- Left-aligned admin nav links -->
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <RouterLink class="nav-link" to="/admin/users">
                Felhasználók
              </RouterLink>
            </li>
            <li class="nav-item">
              <!-- Link to the instrument creation form -->
              <RouterLink class="nav-link" to="/admin/instruments/new">
                Hangszer felvitel
              </RouterLink>
            </li>
          </ul>

          <!-- Right-aligned logout button — neutral styling (not red) -->
          <div class="d-flex gap-2">
            <button class="btn btn-outline-light btn-sm logout-btn" @click="logout">
              Kijelentkezés
            </button>
          </div>

        </div>
      </div>
    </nav>

    <!-- Admin page content — renders the matched /admin/* child route -->
    <main class="admin-content">
      <RouterView />
    </main>

  </div>
</template>

<style scoped>
/** Full-height column so the content area fills the viewport. */
.admin-layout {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

/** Content area takes all remaining space below the navbar. */
.admin-content {
  padding: 20px;
  flex: 1;
}

/**
 * Logout button — deliberately grey/neutral.
 * In the admin panel red signals "destructive action" (delete user, delete rent).
 * The logout button should not compete visually with those elements.
 */
.logout-btn {
  color: #cccccc;
  border-color: #666;
  background: transparent;
}

.logout-btn:hover {
  background: rgba(255, 255, 255, 0.1);
  color: #ffffff;
  border-color: #888;
}
</style>
