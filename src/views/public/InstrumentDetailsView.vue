<!--
  @file InstrumentDetailsView.vue
  @description Detail page for a single instrument. Shows full info + lending form.

  Receives the instrument id as a prop (injected by the router via props: true).
  Loads the instrument, then resolves its category and brand names in parallel
  by fetching the full category/brand lists and finding the matching entry by id.

  Layout:
    Left column (col-lg-7)  — instrument details (title, category, brand,
                               image, condition, description, pricing)
    Right column (col-lg-5) — <LendingForm> component for creating a rental

  Props:
    id {Number|String} — instrument id from the route param :id.

  Emits:
    create:lending — forwarded from LendingForm to the parent (if any).
-->
<script>
import { ref, onMounted } from "vue";
import { RouterLink } from "vue-router";
import axios from "axios";
import LendingForm from "@/components/lending/LendingForm.vue";

export default {
  name: "InstrumentDetailsView",
  components: { LendingForm, RouterLink },
  props: {
    /** Instrument id — injected from the :id route param (props: true in router). */
    id: { type: [Number, String], required: true }
  },
  emits: ["create:lending"],

  setup(props, { emit }) {
    const instrument   = ref(null);
    const categoryName = ref("");
    const brandName    = ref("");
    const loading      = ref(true);
    const error        = ref(null);

    /**
     * Loads the instrument and resolves its category and brand names.
     * Steps:
     *  1. Fetch the instrument by id from /api/instruments/:id.
     *  2. In parallel, fetch all categories and all brands.
     *  3. Find the matching category and brand by id to get their display names.
     *
     * Client-side lookup is used because the instrument endpoint returns
     * category_id and brand_id only, not the display names.
     */
    async function loadInstrument() {
      try {
        loading.value = true;

        /** Step 1: fetch the specific instrument. */
        const instRes  = await axios.get(
            `http://localhost:8000/api/instruments/${props.id}`
        );
        const inst     = instRes.data;
        instrument.value = inst;

        /** Step 2: fetch lookup tables in parallel (faster than sequential). */
        const [catRes, brandRes] = await Promise.all([
          axios.get("http://localhost:8000/api/instrument-categories"),
          axios.get("http://localhost:8000/api/instrument-brands")
        ]);

        /** Step 3: resolve names by matching the foreign key ids. */
        const cat  = catRes.data.find((c) => c.id === inst.category_id);
        const brand = brandRes.data.find((b) => b.id === inst.brand_id);
        categoryName.value = cat   ? cat.category_name  : "Ismeretlen";
        brandName.value    = brand ? brand.brand_name    : "Ismeretlen";

      } catch (err) {
        console.error(err);
        error.value = "Nem található a hangszer.";
      } finally {
        loading.value = false;
      }
    }

    /**
     * Forwards the create:lending event emitted by the child LendingForm
     * up to this component's parent (if any parent listens for it).
     *
     * @param {Object} payload  The new lending payload from LendingForm.
     */
    function forwardCreate(payload) {
      emit("create:lending", payload);
    }

    /**
     * Formats a numeric HUF amount with Hungarian thousand separators.
     * E.g. 15000 → "15 000".
     *
     * @param {number|string} amount
     * @returns {string}
     */
    function formatPrice(amount) {
      const num = Number(amount) || 0;
      return num.toLocaleString('hu-HU');
    }

    /**
     * Builds the absolute URL for an instrument image.
     * If the stored path is already an absolute URL, returns it as-is.
     * If it is a relative path (stored in the DB as e.g. "storage/images/foo.jpg"),
     * prepends the Laravel base URL.
     *
     * @param {string|null} rel  Relative or absolute image path.
     * @returns {string|null}
     */
    function imageUrl(rel) {
      if (!rel) return null;
      if (rel.startsWith('http://') || rel.startsWith('https://')) {
        return rel;
      }
      return `http://localhost:8000/${rel}`;
    }

    onMounted(loadInstrument);

    return {
      instrument,
      categoryName,
      brandName,
      loading,
      error,
      forwardCreate,
      formatPrice,
      imageUrl
    };
  }
};
</script>

<template>
  <!-- Loading state -->
  <section v-if="loading" class="alert alert-info">Betöltés...</section>

  <!-- Error state — shown when the instrument was not found or request failed -->
  <section v-else-if="error" class="alert alert-warning">
    {{ error }}
    <div class="mt-2">
      <RouterLink to="/app/instruments" class="btn btn-outline-dark">
        Vissza
      </RouterLink>
    </div>
  </section>

  <!-- Main content — two-column layout: details left, lending form right -->
  <section v-else class="row g-4">

    <!-- LEFT: instrument details -->
    <div class="col-lg-7">
      <div class="card">
        <div class="card-body">

          <h2 class="card-title mb-1">{{ instrument.title }}</h2>

          <!-- Category and brand names resolved from the lookup tables -->
          <div class="text-muted mb-3">
            - Kategória: {{ categoryName }}
            - Márka: <strong>{{ brandName }}</strong>
          </div>

          <!-- Instrument image (only rendered when an image path is stored) -->
          <div v-if="instrument.image" class="instrument-image-wrapper mb-3">
            <img
                :src="imageUrl(instrument.image)"
                :alt="instrument.title"
                class="instrument-image"
            />
          </div>

          <div class="mb-2">- Állapot: {{ instrument.condition }}</div>

          <div class="mb-2" v-if="instrument.description">
            - Részletek: {{ instrument.description }}
          </div>

          <!-- Pricing block — left gold accent, no hover animation -->
          <div class="price-section mt-3">
            <div class="mb-1">
              <strong>Havi díj:</strong>
              <span class="price-value">{{ formatPrice(instrument.monthly_price) }} Ft / hó</span>
            </div>
            <div>
              <strong>Kaució:</strong>
              <span class="price-value">{{ formatPrice(instrument.deposit) }} Ft</span>
            </div>
          </div>

          <div class="mt-4">
            <RouterLink to="/app/instruments" class="btn btn-outline-secondary">
              Vissza a listához
            </RouterLink>
          </div>

        </div>
      </div>
    </div>

    <!-- RIGHT: lending form -->
    <div class="col-lg-5">
      <!--
        LendingForm handles all rental creation logic.
        forwardCreate bubbles the create:lending event up if any parent needs it.
      -->
      <LendingForm
          :instrument="instrument"
          @create:lending="forwardCreate"
      />
    </div>

  </section>
</template>

<style scoped>
/** Instrument image: responsive, capped height, rounded corners. */
.instrument-image {
  max-width: 100%;
  max-height: 400px;
  object-fit: cover;
  border-radius: 8px;
  display: block;
}

/** Gold left-edge accent for the pricing block — no hover, no transition. */
.price-section {
  padding: 0.75rem 1rem;
  border-left: 3px solid var(--gold, #f5a623);
}

.price-value {
  margin-left: 0.5rem;
  font-weight: 700;
  color: var(--gold, #f5a623);
}
</style>
