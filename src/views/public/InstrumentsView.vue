<script>
import instrumentCard from "@/components/instruments/InstrumentCard.vue";
export default {
  name: "InstrumentsView",
  components:{instrumentCard},
  props:{
    instruments:{type: Array, default: () => [], required: true},
  },
  data(){
    return{
      q:'',
      categories:'',
      brands:''
    }
  },
  computed:{
    categories(){
      return [...new Set(this.instruments.map(r=>r.categories))].sort()
    },
    filtered(){
      const q = this.q.trim().toLowerCase();
      return this.instruments
          .filter(r => (this.categories ? r.categories === this.categories : true))
          .filter(r => (this.brands ? r.brands === this.brands : true))
          .filter(r => {
            if (!q) return true
            return r.name.toLowerCase().includes(q) || r.categories.toLowerCase().includes(q) || r.brands.toLowerCase().includes(q)
          })
    }
  },
  methods:{
    goToDetails(id){
      this.$router.push({name: 'instrument-details', params: {id: id}});
    }
  }
}
</script>

<template>
  <section>
    <div class="d-flex align-items-center justify-content-between mb-3">
      <h2 class="m-0">Hangszerek</h2>
      <input v-model="q" class="form-control w-auto" id="inputQ" placeholder="Keresés név/hangszer...">
    </div>
    <div class="row g-3 mb-4">
      <div class="col-md-4">
        <select class="form-select" v-model="categories">
          <option value="">Összes hangszer</option>
          <option v-for="c in categories" :key="c" :value="c">{{ c }}</option>
        </select>
      </div>
      <div class="col-md-4">
          <select class="form-select" v-model="brands">
            <option value="">Márkák</option>
            <option v-for="c in brands" :key="c" :value="c">{{ c }}</option>
          </select>
      </div>
      <div class="col-md-4 text-md-end">
        <span class="badge bg-dark">{{ filtered.length }}</span>
      </div>
    </div>
    <div class="row g-3">
      <div class="col-md-6 col-lg-4" v-for="r in filtered" :key="r.id">
        <InstrumentCard :instrument="r" @select="goToDetails"/>
      </div>
    </div>

  </section>
</template>

<style scoped>
#inputQ {
  min-width: 260px;
}
</style>