<script>
export default {
  name: "LendingItem",
  props: {
    lending: { type: Object, required: true }
  },
  emits: ['remove'],

  computed: {
    formattedPrice() {
      const price = this.lending.rent_price || 0;
      return price.toLocaleString('hu-HU') + ' Ft';
    },

    formattedMonthlyPrice() {
      const price = this.lending.instrument?.monthly_price || 0;
      return price.toLocaleString('hu-HU') + ' Ft / hó';
    },

    formattedStart() { return this.formatDate(this.lending.start_date); },
    formattedEnd()   { return this.formatDate(this.lending.end_date);   },

    durationDays() {
      if (!this.lending.start_date || !this.lending.end_date) return null;
      const start = new Date(this.lending.start_date);
      const end = new Date(this.lending.end_date);
      const diffMs = end - start;
      const days = Math.ceil(diffMs / (1000 * 60 * 60 * 24));
      return days > 0 ? days : 1;
    },

    /**
     * Computes the lending status from the start and end dates.
     * The backend does not store an explicit status field, so the frontend derives it:
     *  - "Jövőbeli" (Future)   — the rental has not started yet
     *  - "Aktív" (Active)      — the rental is currently in progress
     *  - "Lejárt" (Expired)    — the rental has ended
     *  - "Visszahozva" (Returned) — the user has returned the instrument early
     */
    statusInfo() {
      if (!this.lending.start_date || !this.lending.end_date) {
        return { label: 'Ismeretlen', class: 'bg-secondary' };
      }

      const today = new Date();
      today.setHours(0, 0, 0, 0);
      const start = new Date(this.lending.start_date);
      const end = new Date(this.lending.end_date);

      if (this.lending.real_end_date) {
        return { label: 'Visszahozva', class: 'bg-secondary' };
      }
      if (today < start) {
        return { label: 'Jövőbeli', class: 'bg-info' };
      }
      if (today > end) {
        return { label: 'Lejárt', class: 'bg-warning' };
      }
      return { label: 'Aktív', class: 'bg-success' };
    }
  },

  methods: {
    /**
     * Formats an ISO date string in Hungarian short format (YYYY.MM.DD.).
     */
    formatDate(value) {
      if (!value) return '—';
      const date = new Date(value);
      if (isNaN(date.getTime())) return value;
      return date.toLocaleDateString('hu-HU', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit'
      });
    },

    deleteItem() { this.$emit("remove", this.lending); }
  }
};
</script>

<template>
  <div class="card h-100 lending-card">
    <div class="card-body d-flex flex-column">

      <div class="d-flex justify-content-between align-items-start mb-3">
        <h5 class="card-title mb-0">
          {{ lending.instrument?.title || 'Ismeretlen hangszer' }}
        </h5>
        <span class="badge" :class="statusInfo.class">
          {{ statusInfo.label }}
        </span>
      </div>

      <div class="lending-meta small text-muted mb-3">
        <div class="mb-1">
          <i class="bi bi-calendar-event"></i>
          <span class="ms-1">{{ formattedStart }} → {{ formattedEnd }}</span>
        </div>
        <div v-if="durationDays" class="mb-1">
          <i class="bi bi-clock"></i>
          <span class="ms-1">{{ durationDays }} nap</span>
        </div>
        <div v-if="lending.instrument?.monthly_price">
          <i class="bi bi-tag"></i>
          <span class="ms-1">{{ formattedMonthlyPrice }}</span>
        </div>
      </div>

      <div class="price-box mb-3 mt-auto">
        <span class="small text-muted d-block">Bérleti díj</span>
        <span class="fs-5 fw-bold text-brand">{{ formattedPrice }}</span>
      </div>

      <button type="button"
              class="btn btn-outline-danger btn-sm"
              @click="deleteItem">
        Törlés
      </button>

    </div>
  </div>
</template>

<style scoped>
/* No transition — card is fully static */
.lending-card {
  transition: none;
}

.lending-meta i {
  width: 16px;
  display: inline-block;
  color: var(--gold, #f5a623);
}

.price-box {
  padding: 0.75rem 1rem;
  border-radius: 8px;
  background-color: rgba(245, 166, 35, 0.06);
  border-left: 3px solid var(--gold, #f5a623);
}
</style>