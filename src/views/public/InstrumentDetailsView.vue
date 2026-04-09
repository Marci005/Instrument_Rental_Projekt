<script>
import {RouterLink} from "vue-router";
import LendingForm from "@/components/lending/LendingForm.vue";

export default {
  name: "InstrumentDetailsView",
  components:{
    LendingForm,
    RouterLink
  },
  props: {
    id: {type: [Number, String], required: true},
    instruments: {type: Array, required: true, default: () => []},
  },
  emits:['create:lending'],
  computed:{
    instrument() {
      const rid = Number(this.id);
      return this.instruments.find(r => r.id === rid) || null;
    }
  },
  methods:{
    forwardCreate(payload){
      this.$emit('create:lending', payload);
      this.$router.push( {name: 'lendings'})
    }
  }
}
</script>

<template>
  <section v-if="instrument" class="row g-4">
    <div class="col-lg-7">
      <div class="card">
        <div class="card-body">
          <h2 class="card-title mb-1">{{ instrument.name }}</h2>
          <div class="text-muted mb-3">
           - Kategória: {{ instrument.category }} - Márka: <strong>{{ instrument.brand }}</strong>
          </div>
          <div class="d-flex flex-wrap gap-2">
           - Állapot: {{instrument.condition}}
          </div>
          <div class="d-flex flex-wrap gap-2">
            - Részletek: {{instrument.description}}
          </div>
          <hr>
          <RouterLink to="/instruments" class="btn btn-outline-secondary">Vissza a listához</RouterLink>
        </div>
      </div>
    </div>
    <div class="col-lg-5">
      <LendingForm :instrument="instrument" @create:lending="forwardCreate"/>
    </div>

  </section>
  <section v-else class="alert alert-warning">
    Nincs ilyen hangszer.
    <div class="mt-2">
      <RouterLink to="/instruments" class="btn btn-outline-dark">Vissza</RouterLink>
    </div>
  </section>
</template>

<style scoped>

</style>