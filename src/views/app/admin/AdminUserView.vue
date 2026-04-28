<!--
  @file AdminUserView.vue
  @description Admin page — full user list with management actions.

  Loads all users from /api/users on mount and renders them in a striped
  Bootstrap table. Each row provides three actions:
    - "Kölcsönzések megtekintése" → navigates to AdminUserRentsView for that user
    - "Adminná tétel / Admin jog elvétele" → toggles the is_admin flag via the backend
    - "Törlés" → deletes the user (related rents cascade on the backend)

  Uses the Options API with export default. Data is mutated directly after
  successful API calls to avoid a full reload where possible (toggle-admin
  updates the local object; delete filters the user out of the array).
-->
<script>
import apiHandler from "@/utils/apiHandler";

export default {
  name: "AdminUserView",

  data() {
    return {
      /** Reactive array of all user objects returned by /api/users. */
      users: [],
      loading: true,
      error: null
    };
  },

  methods: {
    /**
     * Fetches the full user list from the backend and stores it in users.
     * Sets loading to false in the finally block regardless of outcome.
     */
    async loadUsers() {
      this.loading = true;
      try {
        const response = await apiHandler.get("/api/users");
        this.users = response.data;
      } catch (err) {
        this.error = "Nem sikerült betölteni a felhasználókat.";
      } finally {
        this.loading = false;
      }
    },

    /**
     * Toggles the is_admin flag of a user via POST /api/users/:id/toggle-admin.
     * On success, updates the local user object so the badge and button label
     * change instantly without refetching the whole list.
     *
     * @param {Object} user  The user row object from the table.
     */
    async toggleAdmin(user) {
      try {
        const response = await apiHandler.post(`/api/users/${user.id}/toggle-admin`);
        /** Mutate the existing object in-place so Vue's reactivity picks up the change. */
        user.is_admin = response.data.is_admin;
      } catch {
        alert("Hiba történt a jogosultság módosításakor.");
      }
    },

    /**
     * Permanently deletes a user after a browser confirm dialog.
     * Related rents and addresses are removed by database cascades on the backend.
     * On success, removes the user from the local array (no reload needed).
     *
     * @param {Object} user  The user to delete.
     */
    async deleteUser(user) {
      if (!confirm(`Biztos törlöd ezt a felhasználót: ${user.email}?`)) return;

      try {
        await apiHandler.delete(`/api/users/${user.id}`);
        /** Filter the deleted user out of the reactive array. */
        this.users = this.users.filter(u => u.id !== user.id);
      } catch {
        alert("Nem sikerült törölni a felhasználót.");
      }
    },

    /**
     * Navigates to the rental list page for the given user.
     * Uses a named route so the URL is not hardcoded here.
     *
     * @param {Object} user  The user whose rentals should be shown.
     */
    viewRents(user) {
      this.$router.push({ name: 'admin-user-rents', params: { id: user.id } });
    }
  },

  /** Load users as soon as the component is mounted. */
  mounted() {
    this.loadUsers();
  }
};
</script>

<template>
  <div class="admin-page">

    <h1 class="mb-4">Admin – Felhasználók kezelése</h1>

    <!-- Error alert -->
    <div v-if="error" class="alert alert-danger">{{ error }}</div>

    <!-- Loading spinner -->
    <div v-if="loading" class="text-center">
      <div class="spinner-border"></div>
      <p>Betöltés...</p>
    </div>

    <!-- User table — only rendered once loading is complete -->
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

        <!-- Admin badge: green when admin, grey when not -->
        <td>
          <span
              class="badge"
              :class="user.is_admin ? 'bg-success' : 'bg-secondary'"
          >
            {{ user.is_admin ? "Igen" : "Nem" }}
          </span>
        </td>

        <!-- View rentals button -->
        <td>
          <button
              class="btn btn-sm btn-outline-info"
              @click="viewRents(user)"
          >
            Kölcsönzések megtekintése
          </button>
        </td>

        <!-- Toggle admin + delete actions -->
        <td>
          <!--
            Toggle admin button.
            Label changes based on the user's current is_admin value.
          -->
          <button
              class="btn btn-sm btn-warning me-2"
              @click="toggleAdmin(user)"
          >
            {{ user.is_admin ? "Admin jog elvétele" : "Adminná tétel" }}
          </button>

          <!-- Delete button — triggers confirmation dialog before deletion -->
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
