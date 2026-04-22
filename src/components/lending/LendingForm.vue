<script>
import api from "@/utils/http";

export default {
  name: "LendingForm",

  props: {
    instrument: { type: Object, required: true }
  },

  data() {
    return {
      start_date: '',
      end_date: '',
      loading: false,
      error: null
    };
  },

  computed: {
    /**
     * A form érvényes, ha mindkét dátum ki van töltve
     * ÉS a záró dátum szigorúan későbbi (a backend `after:start_date` szabálya miatt).
     */
    isValid() {
      if (!this.start_date || !this.end_date) return false;
      return new Date(this.end_date) > new Date(this.start_date);
    },

    /**
     * Kiszámolt bérlési ár a hónapok alapján.
     * Ha 1 hónap vagy kevesebb → teljes havi díj.
     * Minden további megkezdett hónap → plusz havi díj.
     */
    calculatedPrice() {
      if (!this.start_date || !this.end_date) return 0;

      const start = new Date(this.start_date);
      const end = new Date(this.end_date);
      const diffMs = end - start;
      const diffDays = Math.ceil(diffMs / (1000 * 60 * 60 * 24));
      const months = Math.max(1, Math.ceil(diffDays / 30));

      return months * (this.instrument.monthly_price || 0);
    },

    /**
     * Magyar formátumú ár megjelenítéshez.
     */
    formattedCalculatedPrice() {
      return this.calculatedPrice.toLocaleString('hu-HU') + ' Ft';
    },

    /**
     * A dátumválasztó minimum értéke — a backend `after_or_equal:today` miatt
     * múltbeli dátumot nem engedhetünk.
     */
    todayString() {
      return new Date().toISOString().split('T')[0];   // "2026-04-22"
    }
  },

  methods: {
    async submit() {
      if (!this.isValid) {
        this.error = "Tölts ki mindkét dátumot, a záró dátum legyen későbbi a kezdőnél.";
        return;
      }

      this.loading = true;
      this.error = null;

      try {
        await api.post("/api/rents", {
          instrument_id: this.instrument.id,
          rent_price: this.calculatedPrice,
          start_date: this.start_date,
          end_date: this.end_date
        });

        this.$router.push("/app/lendings");

      } catch (err) {
        console.error("Kölcsönzés létrehozási hiba:", err);

        if (err.response?.status === 422 && err.response.data.errors) {
          const errors = err.response.data.errors;
          const firstField = Object.keys(errors)[0];
          this.error = errors[firstField][0];
        } else if (err.response?.status === 401) {
          this.error = "Bejelentkezés szükséges.";
        } else {
          this.error = "Nem sikerült létrehozni a kölcsönzést.";
        }
      } finally {
        this.loading = false;
      }
    }
  }
};
</script>

<template>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title mb-3">Kölcsönzés</h5>

      <div v-if="error" class="alert alert-danger py-2 small">
        {{ error }}
      </div>

      <form @submit.prevent="submit">
        <div class="mb-3">
          <label class="form-label" for="start_date">Kezdő dátum</label>
          <input type="date"
                 class="form-control"
                 id="start_date"
                 v-model="start_date"
                 :min="todayString"
                 :disabled="loading"
                 required />
        </div>

        <div class="mb-3">
          <label class="form-label" for="end_date">Záró dátum</label>
          <input type="date"
                 class="form-control"
                 id="end_date"
                 v-model="end_date"
                 :min="start_date || todayString"
                 :disabled="loading"
                 required />
        </div>

        <!-- Kiszámolt ár kiemelése -->
        <div v-if="isValid" class="price-preview mb-3">
          <span class="small text-muted d-block">Bérleti díj összesen</span>
          <span class="fs-5 fw-bold text-brand">{{ formattedCalculatedPrice }}</span>
        </div>

        <button type="submit"
                class="btn btn-primary w-100"
                :disabled="loading || !isValid">
          {{ loading ? 'Feldolgozás...' : 'Kölcsönzés megerősítése' }}
        </button>
      </form>
    </div>
  </div>
</template>

<style scoped>
.price-preview {
  padding: 0.75rem 1rem;
  border-radius: 8px;
  background-color: rgba(245, 166, 35, 0.06);
  border-left: 3px solid var(--gold, #f5a623);
}
</style>