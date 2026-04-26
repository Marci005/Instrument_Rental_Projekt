<!--
  @file LendingList.vue
  @description Container component that loads and manages the current user's rentals.

  Fetches the rental list from /api/rents on mount, then renders one
  <LendingItem> card per rental in a responsive Bootstrap grid.

  Handles three list states:
    - loading  → shows a Bootstrap info alert
    - error    → shows a danger alert with a message
    - empty    → shows an empty-state block with a link to /app/instruments
    - filled   → renders a responsive card grid

  Also handles the 'remove' event from LendingItem (deletion with confirmation)
  and the 'update' event (currently re-fetches from backend; extensible for
  an edit modal in the future).
-->
<script>
import LendingItem from "./LendingItem.vue";
import api from "@/utils/http";

export default {
  name: "LendingList",
  components: { LendingItem },

  data() {
    return {
      lendings: [],   // Array of rental objects returned by the backend
      loading:  false,
      error:    null
    };
  },

  methods: {
    /**
     * Loads all rentals for the current authenticated user from /api/rents.
     * The Axios instance sends the session cookie automatically
     * (withCredentials: true in http.js), so no Bearer token is needed.
     * On 401 shows a specific message; on other errors shows a generic one.
     */
    async loadData() {
      this.loading = true;
      this.error   = null;

      try {
        const { data } = await api.get("/api/rents");
        this.lendings  = data;
      } catch (err) {
        console.error("Kölcsönzések betöltési hiba:", err);
        this.error = err.response?.status === 401
            ? "Bejelentkezés szükséges."
            : "Nem sikerült betölteni a kölcsönzéseket.";
      } finally {
        this.loading = false;
      }
    },

    /**
     * Deletes a rental after a native browser confirmation dialog.
     * On success, reloads the full list so the deleted card disappears immediately.
     * Shows a native alert on failure.
     *
     * @param {Object} lending  The rental object emitted by LendingItem's 'remove' event.
     */
    async remove(lending) {
      if (!confirm(`Biztosan törlöd ezt a kölcsönzést: "${lending.instrument?.title || 'ismeretlen'}"?`)) {
        return;
      }

      try {
        await api.delete(`/api/rents/${lending.id}`);
        await this.loadData(); // Reload list to reflect the deletion
      } catch (err) {
        console.error("Törlési hiba:", err);
        alert("Nem sikerült törölni a kölcsönzést.");
      }
    },

    /**
     * Handles the 'update' event from LendingItem.
     * Currently sends a PUT and reloads the list.
     * Can be extended to open an edit modal instead of a full reload.
     *
     * @param {Object} lending  The updated lending object.
     */
    async update(lending) {
      try {
        await api.put(`/api/rents/${lending.id}`, lending);
        await this.loadData();
      } catch (err) {
        console.error("Módosítási hiba:", err);
        alert("Nem sikerült módosítani a kölcsönzést.");
      }
    }
  },

  /** Load rentals as soon as the component is inserted into the DOM. */
  mounted() {
    this.loadData();
  }
};
</script>

<template>
  <div class="lending-list">

    <!-- Loading state -->
    <div v-if="loading" class="alert alert-info">
      Betöltés...
    </div>

    <!-- Error state -->
    <div v-else-if="error" class="alert alert-danger">
      {{ error }}
    </div>

    <!-- Empty state — shown when the user has no rentals yet -->
    <div v-else-if="lendings.length === 0" class="empty-state text-center py-5">
      <div class="mb-3" style="font-size: 3rem; opacity: 0.5;">🎻</div>
      <h5 class="text-muted">Még nincs aktív kölcsönzésed</h5>
      <p class="text-muted small">
        Böngészd át a hangszereket és válassz ki egyet!
      </p>
      <RouterLink to="/app/instruments" class="btn btn-warning mt-2">
        Hangszerek böngészése
      </RouterLink>
    </div>

    <!-- Filled state — responsive Bootstrap card grid -->
    <div v-else class="row g-3">
      <!--
        Each rental gets its own column.
        Columns: 1 on mobile, 2 on md, 3 on lg.
        @remove → remove()  deletes the rental
        @update → update()  updates the rental (future: open edit modal)
      -->
      <div class="col-12 col-md-6 col-lg-4"
           v-for="l in lendings"
           :key="l.id">
        <LendingItem
            :lending="l"
            @remove="remove"
            @update="update"
        />
      </div>
    </div>

  </div>
</template>

<style scoped>
/** Empty-state box: dark background with a subtle gold dashed border. */
.empty-state {
  background-color: var(--bg-2, #1d1917);
  border: 1px dashed rgba(245, 166, 35, 0.2);
  border-radius: 12px;
  padding: 3rem 1rem;
}
</style>
