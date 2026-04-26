<script>
import { useAuthStore } from "@/utils/authStore.js";
import { useRouter } from "vue-router";

export default {
  name: "AdminLayout",
  setup() {
    const auth = useAuthStore();
    const router = useRouter();

    /**
     * Logs out the current user and redirects to the public home page.
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
  <div class="admin-layout">

    <!-- Admin navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
      <div class="container-fluid">

        <RouterLink class="navbar-brand" to="/admin/users">Admin Panel</RouterLink>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#adminNav"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="adminNav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <RouterLink class="nav-link" to="/admin/users">Felhasználók</RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink class="nav-link" to="/admin/instruments/new">Hangszer felvitel</RouterLink>
            </li>
          </ul>

          <div class="d-flex gap-2">
            <button class="btn btn-outline-light btn-sm logout-btn" @click="logout">
              Kijelentkezés
            </button>
          </div>
        </div>

      </div>
    </nav>

    <!-- Admin page content -->
    <main class="admin-content">
      <RouterView />
    </main>

  </div>
</template>

<style scoped>
.admin-layout {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

.admin-content {
  padding: 20px;
  flex: 1;
}

/* Logout button — neutral styling, not red */
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
