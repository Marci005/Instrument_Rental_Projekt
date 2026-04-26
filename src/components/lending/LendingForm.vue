<!--
  @file LendingForm.vue
  @description Form component for creating a new instrument rental.

  Receives the instrument object as a prop. The user picks a start date and
  an end date; the component computes the total rental price client-side
  based on the instrument's monthly_price and the number of months between
  the two dates (minimum 1 month, each started month is billed fully).

  On submit, sends a POST to /api/rents and redirects to /app/lendings on
  success. On validation failure (HTTP 422), shows the first field error.

  Props:
    instrument {Object} — the instrument being rented (id, monthly_price required).
-->
<script>
import api from "@/utils/http";

export default {
  name: "LendingForm",

  props: {
    /** Instrument object. The id and monthly_price fields are used in the form logic. */
    instrument: { type: Object, required: true }
  },

  data() {
    return {
      start_date: '',   // ISO date string selected by the user (e.g. "2026-05-01")
      end_date: '',     // ISO date string; must be strictly after start_date
      loading: false,   // True while the POST request is in flight
      error: null       // Error message string shown in the alert box
    };
  },

  computed: {
    /**
     * Returns true when both dates are filled in AND the end date is strictly
     * after the start date. Mirrors the backend's `after:start_date` validation
     * rule so the user sees the error before hitting Submit.
     */
    isValid() {
      if (!this.start_date || !this.end_date) return false;
      return new Date(this.end_date) > new Date(this.start_date);
    },

    /**
     * Computes the total rental price from the date range.
     * Algorithm:
     *   1. Calculate the difference in milliseconds, convert to days (ceil).
     *   2. Convert days to months (ceil, minimum 1).
     *   3. Multiply months by the instrument's monthly_price.
     * This matches the backend's billing model (each started month is charged fully).
     */
    calculatedPrice() {
      if (!this.start_date || !this.end_date) return 0;

      const start   = new Date(this.start_date);
      const end     = new Date(this.end_date);
      const diffMs  = end - start;
      const diffDays = Math.ceil(diffMs / (1000 * 60 * 60 * 24));
      const months  = Math.max(1, Math.ceil(diffDays / 30));

      return months * (this.instrument.monthly_price || 0);
    },

    /**
     * Hungarian-formatted price string shown in the preview box
     * (e.g. "15 000 Ft" instead of raw "15000").
     */
    formattedCalculatedPrice() {
      return this.calculatedPrice.toLocaleString('hu-HU') + ' Ft';
    },

    /**
     * Today's date as an ISO string (YYYY-MM-DD).
     * Used as the `min` attribute on both date inputs so the user cannot
     * select a past date — the backend enforces `after_or_equal:today`.
     */
    todayString() {
      return new Date().toISOString().split('T')[0];
    }
  },

  methods: {
    /**
     * Handles form submission.
     * Guards: validates dates client-side first.
     * Sends a POST to /api/rents with the computed price.
     * On success: navigates to the rental list page.
     * On 422: shows the first Laravel validation error.
     * On 401: shows a login-required message.
     * On any other error: shows a generic failure message.
     */
    async submit() {
      if (!this.isValid) {
        this.error = "Tölts ki mindkét dátumot, a záró dátum legyen későbbi a kezdőnél.";
        return;
      }

      this.loading = true;
      this.error   = null;

      try {
        await api.post("/api/rents", {
          instrument_id: this.instrument.id,
          rent_price:    this.calculatedPrice,
          start_date:    this.start_date,
          end_date:      this.end_date
        });

        /** Navigate to the user's rental list after successful creation. */
        this.$router.push("/app/lendings");

      } catch (err) {
        console.error("Kölcsönzés létrehozási hiba:", err);

        if (err.response?.status === 422 && err.response.data.errors) {
          /** Show only the first field error to keep the UI clean. */
          const errors    = err.response.data.errors;
          const firstField = Object.keys(errors)[0];
          this.error      = errors[firstField][0];
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

      <!-- Error alert — shown only when this.error is set -->
      <div v-if="error" class="alert alert-danger py-2 small">
        {{ error }}
      </div>

      <!-- @submit.prevent stops the native browser form submission -->
      <form @submit.prevent="submit">

        <!-- Start date input — min set to today so past dates are disabled -->
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

        <!-- End date input — min is dynamically the selected start date -->
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

        <!--
          Price preview — visible only when both dates are valid.
          Gives the user instant feedback before they confirm.
        -->
        <div v-if="isValid" class="price-preview mb-3">
          <span class="small text-muted d-block">Bérleti díj összesen</span>
          <span class="fs-5 fw-bold text-brand">{{ formattedCalculatedPrice }}</span>
        </div>

        <!--
          Submit button — disabled while loading or when the form is invalid.
          Label changes to "Feldolgozás..." during the async request.
        -->
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
/** Left-edge gold accent box used to highlight the computed total price. */
.price-preview {
  padding: 0.75rem 1rem;
  border-radius: 8px;
  background-color: rgba(245, 166, 35, 0.06);
  border-left: 3px solid var(--gold, #f5a623);
}
</style>
