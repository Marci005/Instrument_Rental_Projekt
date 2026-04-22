<script>
import {useAuthStore} from "@/utils/authStore.js";
import {useRouter} from "vue-router";

export default {
  name: "AdminLayout",
  setup() {
    const auth = useAuthStore();
    const router = useRouter();

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

    <!-- ADMIN NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
      <div class="container-fluid">

        <RouterLink class="navbar-brand" to="/admin/users">
          Admin Panel
        </RouterLink>

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
              <RouterLink class="nav-link" to="/admin/users">
                Felhasználók
              </RouterLink>
            </li>

            <li class="nav-item">
              <RouterLink class="nav-link" to="/admin/lendings">
                Kölcsönzések
              </RouterLink>
            </li>

            <li class="nav-item">
              <RouterLink class="nav-link" to="/admin/settings">
                Beállítások
              </RouterLink>
            </li>

          </ul>

          <div class="d-flex gap-2">
            <button class="btn btn-danger btn-sm" @click="logout">
              Kijelentkezés
            </button>
          </div>
        </div>

      </div>
    </nav>
    <!-- ADMIN OLDAL TARTALMA -->
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

.admin-nav {
  display: flex;
  align-items: center;
  gap: 20px;
  background: #222;
  padding: 15px 25px;
}

.admin-nav a {
  color: white;
  text-decoration: none;
  font-weight: 500;
}

.admin-nav a:hover {
  text-decoration: underline;
}

.logout-btn {
  margin-left: auto;
  background: #ff4444;
  border: none;
  padding: 8px 14px;
  color: white;
  cursor: pointer;
  border-radius: 4px;
}

.logout-btn:hover {
  background: #cc0000;
}

.admin-content {
  padding: 20px;
  flex: 1;
}
</style>
