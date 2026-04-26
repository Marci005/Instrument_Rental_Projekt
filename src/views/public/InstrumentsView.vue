<!--
  @file InstrumentsView.vue
  @description Public + authenticated instrument catalogue page.

  On mount, fetches all instruments, categories and brands in parallel.
  Categories and brands are stored separately from instruments so the
  component can resolve the display names client-side via the enrichedInstruments
  computed property (the API returns only category_id / brand_id foreign keys).

  Provides three filter controls:
    - Free-text search (q) — matches against title, category_name, brand_name
    - Category dropdown (selectedCategory) — filters by category_id
    - Brand dropdown (selectedBrand) — filters by brand_id

  The filtered result count is shown next to the dropdowns.
  Each matching instrument is rendered as an <InstrumentCard> in a Bootstrap grid.
-->
<script>
import axios from "axios"
import InstrumentCard from "@/components/instruments/InstrumentCard.vue"

export default {
  name: "InstrumentsView",
  components: { InstrumentCard },

  data() {
    return {
      instruments:      [],   // Raw instrument array from the backend
      categories:       [],   // All categories (for dropdown + name lookup)
      brands:           [],   // All brands (for dropdown + name lookup)
      q:                "",   // Free-text search query
      selectedCategory: "",   // Currently selected category id (or "" for all)
      selectedBrand:    "",   // Currently selected brand id (or "" for all)
      loading:          false,
      error:            null
    }
  },

  computed: {
    /**
     * Attaches category_name and brand_name strings to every instrument object
     * by looking them up in the categories/brands arrays by id.
     * This avoids extra API calls per instrument — one API call for all categories
     * and one for all brands is enough, then the join happens on the client.
     *
     * @returns {Object[]} Instruments with category_name and brand_name appended.
     */
    enrichedInstruments() {
      return this.instruments.map(inst => {
        const cat   = this.categories.find(c => c.id === inst.category_id)
        const brand = this.brands.find(b => b.id === inst.brand_id)
        return {
          ...inst,
          category_name: cat   ? cat.category_name   : '',
          brand_name:    brand ? brand.brand_name     : ''
        }
      })
    },

    /**
     * Applies all three active filters to enrichedInstruments.
     * Each filter is skipped when its value is empty/falsy.
     * Uses loose == comparison for category/brand ids because v-model on
     * <select> returns strings while the instrument object has numeric ids.
     *
     * @returns {Object[]} Filtered and enriched instrument list.
     */
    filtered() {
      const q = this.q.trim().toLowerCase()
      return this.enrichedInstruments
          .filter(r => (this.selectedCategory ? r.category_id == this.selectedCategory : true))
          .filter(r => (this.selectedBrand    ? r.brand_id    == this.selectedBrand    : true))
          .filter(r => {
            if (!q) return true
            return (
                r.title?.toLowerCase().includes(q) ||
                r.category_name?.toLowerCase().includes(q) ||
                r.brand_name?.toLowerCase().includes(q)
            )
          })
    }
  },

  /**
   * Fetches instruments, categories and brands in parallel on mount.
   * Promise.all ensures all three requests finish before the list is rendered,
   * preventing a flash of cards with unresolved names.
   */
  async mounted() {
    this.loading = true
    try {
      const [instrRes, catRes, brandRes] = await Promise.all([
        axios.get("http://localhost:8000/api/instruments"),
        axios.get("http://localhost:8000/api/instrument-categories"),
        axios.get("http://localhost:8000/api/instrument-brands")
      ])
      this.instruments = instrRes.data
      this.categories  = catRes.data
      this.brands      = brandRes.data
    } catch (err) {
      console.error(err)
      this.error = "Nem sikerült betölteni a hangszereket."
    } finally {
      this.loading = false
    }
  },

  methods: {
    /**
     * Navigates to the instrument detail page.
     * Used by child components that emit a 'select' event.
     * @param {number} id  Instrument id.
     */
    goToDetails(id) {
      this.$router.push({ name: "instrument-details", params: { id } })
    }
  }
}
</script>

<template>
  <section>
    <h2 class="mb-3">Hangszerek</h2>

    <!-- Free-text search input -->
    <div class="d-flex align-items-center justify-content-between mb-3">
      <input v-model="q" class="form-control w-auto" placeholder="Keresés név/hangszer...">
    </div>

    <!-- Filter row: category dropdown, brand dropdown, result count badge -->
    <div class="row g-3 mb-4">
      <div class="col-md-4">
        <!-- Category filter — "" means "show all" -->
        <select class="form-select" v-model="selectedCategory">
          <option value="">Összes kategória</option>
          <option v-for="cat in categories" :key="cat.id" :value="cat.id">
            {{ cat.category_name }}
          </option>
        </select>
      </div>
      <div class="col-md-4">
        <!-- Brand filter — "" means "show all" -->
        <select class="form-select" v-model="selectedBrand">
          <option value="">Összes márka</option>
          <option v-for="brand in brands" :key="brand.id" :value="brand.id">
            {{ brand.brand_name }}
          </option>
        </select>
      </div>
      <div class="col-md-4 text-md-end">
        <!-- Live result count badge, updates as filters change -->
        <span class="badge bg-dark">{{ filtered.length }}</span>
      </div>
    </div>

    <!-- Instrument card grid — one card per filtered instrument -->
    <div class="row g-3">
      <div class="col-md-6 col-lg-4" v-for="r in filtered" :key="r.id">
        <!-- InstrumentCard receives the enriched instrument (with name fields) -->
        <InstrumentCard :instrument="r" @select="goToDetails" />
      </div>
    </div>
  </section>
</template>
