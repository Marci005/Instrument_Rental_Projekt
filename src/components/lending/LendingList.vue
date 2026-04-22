<script>
import LendingItem from "./LendingItem.vue";
import api from "@/utils/http";

export default {
  name: "LendingList",
  components: { LendingItem },

  data() {
    return {
      lendings: [],
      loading: false,
      error: null
    };
  },

  methods: {
    /**
     * Kölcsönzések lekérése a backend-ről.
     * Az `api` Axios példány automatikusan kezeli a Sanctum session cookie-t
     * (withCredentials: true) — ezért nem kell Bearer tokent kézzel beállítani.
     */
    async loadData() {
      this.loading = true;
      this.error = null;

      try {
        const { data } = await api.get("/api/rents");
        this.lendings = data;
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
     * Kölcsönzés törlése — megerősítéssel.
     * Siker esetén újratölti a listát, hogy azonnal eltűnjön a UI-ból.
     */
    async remove(lending) {
      if (!confirm(`Biztosan törlöd ezt a kölcsönzést: "${lending.instrument?.title || 'ismeretlen'}"?`)) {
        return;
      }

      try {
        await api.delete(`/api/rents/${lending.id}`);
        await this.loadData();
      } catch (err) {
        console.error("Törlési hiba:", err);
        alert("Nem sikerült törölni a kölcsönzést.");
      }
    },

    /**
     * A LendingItem "update" event-jét kezeli. Jelenleg csak
     * újratölti a listát a backendről — jövőbeli bővítéshez
     * itt lehet majd szerkesztő modált nyitni.
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

  mounted() {
    this.loadData();
  }
};
</script>

<template>
  <div class="lending-list">
    <!-- Loading állapot -->
    <div v-if="loading" class="alert alert-info">
      Betöltés...
    </div>

    <!-- Hiba -->
    <div v-else-if="error" class="alert alert-danger">
      {{ error }}
    </div>

    <!-- Üres lista -->
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

    <!-- Lista -->
    <div v-else class="row g-3">
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
.empty-state {
  background-color: var(--bg-2, #1d1917);
  border: 1px dashed rgba(245, 166, 35, 0.2);
  border-radius: 12px;
  padding: 3rem 1rem;
}
</style>
