<script setup>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import apiHandler from "@/utils/apiHandler";

const router = useRouter();

const users = ref([]);
const loading = ref(true);
const error = ref(null);

/**
 * Loads all users from the backend.
 */
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

/**
 * Toggles the is_admin flag of the given user via the backend endpoint.
 * Updates the user object locally on success.
 */
async function toggleAdmin(user) {
  try {
    const response = await apiHandler.post(`/api/users/${user.id}/toggle-admin`);
    user.is_admin = response.data.is_admin;
  } catch {
    alert("Hiba történt a jogosultság módosításakor.");
  }
}

/**
 * Deletes the user from the system after confirmation.
 * Related rents and addresses are deleted via database cascade.
 */
async function deleteUser(user) {
  if (!confirm(`Biztos törlöd ezt a felhasználót: ${user.email}?`)) return;

  try {
    await apiHandler.delete(`/api/users/${user.id}`);
    users.value = users.value.filter(u => u.id !== user.id);
  } catch {
    alert("Nem sikerült törölni a felhasználót.");
  }
}

/**
 * Navigates to the rents page of the selected user.
 */
function viewRents(user) {
  router.push({ name: 'admin-user-rents', params: { id: user.id } });
}

onMounted(() => {
  loadUsers();
});
</script>

<template>
  <div class="admin-page">

    <h1 class="mb-4">Admin – Felhasználók kezelése</h1>

    <div v-if="error" class="alert alert-danger">{{ error }}</div>

    <div v-if="loading" class="text-center">
      <div class="spinner-border"></div>
      <p>Betöltés...</p>
    </div>

    <table v-if="!loading" class="table table-striped table-bordered align-middle">
      <thead>
      <tr>
        <th>ID</th>
        <th>Név</th>
        <th>Email</th>
        <th>Admin?</th>
        <th>Kölcsönzések</th>
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
              class="btn btn-sm btn-outline-info"
              @click="viewRents(user)"
          >
            Kölcsönzések megtekintése
          </button>
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
</style>
