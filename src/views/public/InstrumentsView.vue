<script>
import axios from "axios"
import InstrumentCard from "@/components/instruments/InstrumentCard.vue"

export default {
  name: "InstrumentsView",
  components: { InstrumentCard },

  data() {
    return {
      instruments: [],
      categories: [],
      brands: [],
      q: "",
      selectedCategory: "",
      selectedBrand: "",
      loading: false,
      error: null
    }
  },

  computed: {
    /**
     * Minden hangszerhez hozzáfűzi a kategória- és márkanevet
     * a categories/brands tömbökből, ID alapján kikeresve.
     * Így a kártya komponens simán eléri: instrument.category_name, instrument.brand_name
     */
    enrichedInstruments() {
      return this.instruments.map(inst => {
        const cat = this.categories.find(c => c.id === inst.category_id)
        const brand = this.brands.find(b => b.id === inst.brand_id)
        return {
          ...inst,
          category_name: cat ? cat.category_name : '',
          brand_name: brand ? brand.brand_name : ''
        }
      })
    },

    filtered() {
      const q = this.q.trim().toLowerCase()
      return this.enrichedInstruments
          .filter(r => (this.selectedCategory ? r.category_id == this.selectedCategory : true))
          .filter(r => (this.selectedBrand ? r.brand_id == this.selectedBrand : true))
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

  async mounted() {
    this.loading = true
    try {
      const [instrRes, catRes, brandRes] = await Promise.all([
        axios.get("http://localhost:8000/api/instruments"),
        axios.get("http://localhost:8000/api/instrument-categories"),
        axios.get("http://localhost:8000/api/instrument-brands")
      ])
      this.instruments = instrRes.data
      this.categories = catRes.data
      this.brands = brandRes.data
    } catch (err) {
      console.error(err)
      this.error = "Nem sikerült betölteni a hangszereket."
    } finally {
      this.loading = false
    }
  },

  methods: {
    goToDetails(id) {
      this.$router.push({ name: "instrument-details", params: { id } })
    }
  }
}
</script>

<template>
  <section>
    <h2 class="mb-3">Hangszerek</h2>
    <div class="d-flex align-items-center justify-content-between mb-3">
      <input v-model="q" class="form-control w-auto" placeholder="Keresés név/hangszer...">
    </div>
    <div class="row g-3 mb-4">
      <div class="col-md-4">
        <select class="form-select" v-model="selectedCategory">
          <option value="">Összes kategória</option>
          <option v-for="cat in categories" :key="cat.id" :value="cat.id">
            {{ cat.category_name }}
          </option>
        </select>
      </div>
      <div class="col-md-4">
        <select class="form-select" v-model="selectedBrand">
          <option value="">Összes márka</option>
          <option v-for="brand in brands" :key="brand.id" :value="brand.id">
            {{ brand.brand_name }}
          </option>
        </select>
      </div>
      <div class="col-md-4 text-md-end">
        <span class="badge bg-dark">{{ filtered.length }}</span>
      </div>
    </div>
    <div class="row g-3">
      <div class="col-md-6 col-lg-4" v-for="r in filtered" :key="r.id">
        <InstrumentCard :instrument="r" @select="goToDetails" />
      </div>
    </div>
  </section>
</template>