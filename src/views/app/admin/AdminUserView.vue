<script setup>
import { ref, onMounted } from "vue";
import apiHandler from "@/utils/apiHandler";
import { useAuthStore } from "@/utils/authStore";

const auth = useAuthStore();

const users = ref([]);
const loading = ref(true);
const error = ref(null);

async function loadUsers() {
  loading.value = true;
  try {
    const response = await apiHandler.get("/api/users");
    users.value = response.data;
  } catch (err) {
    error.value = "Nem sikerült betölteni a felhasználókat.";
  } finally {
    loading.value = false;
  }
}


async function toggleAdmin(user) {
  try {
    await apiHandler.post(`/admin/users/${user.id}/toggle-admin`);
    user.is_admin = user.is_admin ? 0 : 1;
  } catch {
    alert("Hiba történt a jogosultság módosításakor.");
  }
}

// 🔥 Felhasználó törlése
async function deleteUser(user) {
  if (!confirm(`Biztos törlöd: ${user.email}?`)) return;

  try {
    await apiHandler.delete(`/admin/users/${user.id}`);
    users.value = users.value.filter(u => u.id !== user.id);
  } catch {
    alert("Nem sikerült törölni a felhasználót.");
  }
}

onMounted(() => {
  loadUsers();
});
</script>

<template>
  <div class="admin-page">

    <nav class="admin-nav mb-4">
      <RouterLink to="/admin/lendings" class="btn btn-outline-primary me-2">
        Kölcsönzések kezelése
      </RouterLink>

      <RouterLink to="/admin/users" class="btn btn-primary me-2">
        Felhasználók kezelése
      </RouterLink>

      <RouterLink to="/admin/settings" class="btn btn-outline-primary">
        Admin beállítások
      </RouterLink>
    </nav>

    <h1 class="mb-4">Admin – Felhasználók kezelése</h1>

    <div v-if="error" class="alert alert-danger">{{ error }}</div>

    <div v-if="loading" class="text-center">
      <div class="spinner-border"></div>
      <p>Betöltés...</p>
    </div>

    <table v-if="!loading" class="table table-striped table-bordered">
      <thead>
      <tr>
        <th>ID</th>
        <th>Név</th>
        <th>Email</th>
        <th>Admin?</th>
        <th>Műveletek</th>
      </tr>
      </thead>

      <tbody>
      <tr v-for="user in users" :key="user.id">
        <td>{{ user.id }}</td>
        <td>{{ user.first_name }} {{ user.last_name }}</td>
        <td>{{ user.email }}</td>

        <td>
            <span
                class="badge"
                :class="user.is_admin ? 'bg-success' : 'bg-secondary'"
            >
              {{ user.is_admin ? "Igen" : "Nem" }}
            </span>
        </td>

        <td>
          <button
              class="btn btn-sm btn-warning me-2"
              @click="toggleAdmin(user)"
          >
            {{ user.is_admin ? "Admin jog elvétele" : "Adminná tétel" }}
          </button>

          <button
              class="btn btn-sm btn-danger"
              @click="deleteUser(user)"
          >
            Törlés
          </button>
        </td>
      </tr>
      </tbody>
    </table>

  </div>
</template>

<style scoped>
.admin-page {
  padding: 20px;
}

.admin-nav {
  display: flex;
  gap: 10px;
}
</style>
