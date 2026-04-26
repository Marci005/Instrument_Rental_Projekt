<!--
  @file LendingItem.vue
  @description Card component that displays a single rental record.

  Shows the instrument name, rental period (start → end), duration in days,
  monthly price, total rental price, and a status badge derived from the dates.
  Emits a 'remove' event with the lending object when the delete button is clicked.

  The backend does not store an explicit status field, so statusInfo() derives
  the display label from the dates at render time:
    - "Jövőbeli" (Future)    — rental has not started yet
    - "Aktív"    (Active)    — rental is currently in progress
    - "Lejárt"   (Expired)   — rental period has ended
    - "Visszahozva" (Returned) — instrument was returned early (real_end_date set)

  Props:
    lending {Object} — full rental record including a nested instrument object.

  Emits:
    remove — emitted with the lending object when the user clicks "Törlés".
-->
<script>
export default {
  name: "LendingItem",
  props: {
    /** Full rental object. Expected fields: id, start_date, end_date,
     *  real_end_date, rent_price, instrument { title, monthly_price }. */
    lending: { type: Object, required: true }
  },
  emits: ['remove'],

  computed: {
    /** Total rental price formatted with Hungarian thousand separators (e.g. "12 000 Ft"). */
    formattedPrice() {
      const price = this.lending.rent_price || 0;
      return price.toLocaleString('hu-HU') + ' Ft';
    },

    /** Instrument monthly price formatted as "X Ft / hó". */
    formattedMonthlyPrice() {
      const price = this.lending.instrument?.monthly_price || 0;
      return price.toLocaleString('hu-HU') + ' Ft / hó';
    },

    /** Formatted start date string (calls formatDate helper). */
    formattedStart() { return this.formatDate(this.lending.start_date); },

    /** Formatted end date string (calls formatDate helper). */
    formattedEnd()   { return this.formatDate(this.lending.end_date);   },

    /**
     * Number of days between start_date and end_date.
     * Uses Math.ceil so a 1.5-day period counts as 2 days.
     * Returns null when either date is missing.
     * Minimum value is 1 (avoids showing 0 days for same-day entries).
     */
    durationDays() {
      if (!this.lending.start_date || !this.lending.end_date) return null;
      const start  = new Date(this.lending.start_date);
      const end    = new Date(this.lending.end_date);
      const diffMs = end - start;
      const days   = Math.ceil(diffMs / (1000 * 60 * 60 * 24));
      return days > 0 ? days : 1;
    },

    /**
     * Derives a display status and Bootstrap badge class from the rental dates.
     * Comparison is done against today at midnight (time stripped) so the
     * status does not flicker during the day.
     *
     * @returns {{ label: string, class: string }}
     */
    statusInfo() {
      if (!this.lending.start_date || !this.lending.end_date) {
        return { label: 'Ismeretlen', class: 'bg-secondary' };
      }

      const today = new Date();
      today.setHours(0, 0, 0, 0);          // Strip time component for day-level comparison
      const start = new Date(this.lending.start_date);
      const end   = new Date(this.lending.end_date);

      if (this.lending.real_end_date) {
        /** real_end_date is set when the instrument is returned before end_date. */
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
     * Formats an ISO date string (YYYY-MM-DD or full ISO) into the Hungarian
     * short format: YYYY.MM.DD. using the browser's Intl API.
     * Returns '—' for falsy input and falls back to the raw string if parsing fails.
     *
     * @param {string|null} value  ISO date string or null/undefined.
     * @returns {string}
     */
    formatDate(value) {
      if (!value) return '—';
      const date = new Date(value);
      if (isNaN(date.getTime())) return value;
      return date.toLocaleDateString('hu-HU', {
        year:  'numeric',
        month: '2-digit',
        day:   '2-digit'
      });
    },

    /**
     * Emits the 'remove' event with this lending object.
     * The parent (LendingList) listens to @remove and handles the API call
     * and confirmation dialog.
     */
    deleteItem() { this.$emit("remove", this.lending); }
  }
};
</script>

<template>
  <div class="card h-100 lending-card">
    <div class="card-body d-flex flex-column">

      <!-- Header: instrument name + status badge -->
      <div class="d-flex justify-content-between align-items-start mb-3">
        <h5 class="card-title mb-0">
          {{ lending.instrument?.title || 'Ismeretlen hangszer' }}
        </h5>
        <!-- Badge class and label are set dynamically by the statusInfo computed property -->
        <span class="badge" :class="statusInfo.class">
          {{ statusInfo.label }}
        </span>
      </div>

      <!-- Rental metadata: date range, duration, monthly price -->
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

      <!-- Total rental price — gold accent box, pushed to the bottom via mt-auto -->
      <div class="price-box mb-3 mt-auto">
        <span class="small text-muted d-block">Bérleti díj</span>
        <span class="fs-5 fw-bold text-brand">{{ formattedPrice }}</span>
      </div>

      <!-- Delete button — emits 'remove'; the parent handles confirmation and API call -->
      <button type="button"
              class="btn btn-outline-danger btn-sm"
              @click="deleteItem">
        Törlés
      </button>

    </div>
  </div>
</template>

<style scoped>
/** No hover animation — card is purely a display component. */
.lending-card {
  transition: none;
}

/** Gold icon colour for the metadata row icons. */
.lending-meta i {
  width: 16px;
  display: inline-block;
  color: var(--gold, #f5a623);
}

/** Gold left-edge accent box for the total price display. */
.price-box {
  padding: 0.75rem 1rem;
  border-radius: 8px;
  background-color: rgba(245, 166, 35, 0.06);
  border-left: 3px solid var(--gold, #f5a623);
}
</style>
