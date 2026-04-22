<script>
import { ref, onMounted } from "vue";
import { RouterLink } from "vue-router";
import axios from "axios";
import LendingForm from "@/components/lending/LendingForm.vue";

export default {
  name: "InstrumentDetailsView",
  components: { LendingForm, RouterLink },

  props: {
    id: { type: [Number, String], required: true }
  },

  emits: ["create:lending"],

  setup(props, { emit }) {
    const instrument = ref(null);
    const categoryName = ref("");
    const brandName = ref("");
    const loading = ref(true);
    const error = ref(null);

    async function loadInstrument() {
      try {
        loading.value = true;

        const instRes = await axios.get(
            `http://localhost:8000/api/instruments/${props.id}`
        );
        const inst = instRes.data;
        instrument.value = inst;

        const [catRes, brandRes] = await Promise.all([
          axios.get("http://localhost:8000/api/instrument-categories"),
          axios.get("http://localhost:8000/api/instrument-brands")
        ]);

        const cat = catRes.data.find((c) => c.id === inst.category_id);
        const brand = brandRes.data.find((b) => b.id === inst.brand_id);

        categoryName.value = cat ? cat.category_name : "Ismeretlen";
        brandName.value = brand ? brand.brand_name : "Ismeretlen";
      } catch (err) {
        console.error(err);
        error.value = "Nem található a hangszer.";
      } finally {
        loading.value = false;
      }
    }

    function forwardCreate(payload) {
      emit("create:lending", payload);
    }

    onMounted(loadInstrument);

    return {
      instrument,
      categoryName,
      brandName,
      loading,
      error,
      forwardCreate
    };
  }
};
</script>

<template>
  <section v-if="loading" class="alert alert-info">Betöltés...</section>

  <section v-else-if="error" class="alert alert-warning">
    {{ error }}
    <div class="mt-2">
      <RouterLink to="/app/instruments" class="btn btn-outline-dark">
        Vissza
      </RouterLink>
    </div>
  </section>

  <section v-else class="row g-4">
    <div class="col-lg-7">
      <div class="card">
        <div class="card-body">
          <h2 class="card-title mb-1">{{ instrument.title }}</h2>

          <div class="text-muted mb-3">
            - Kategória: {{ categoryName }}
            - Márka: <strong>{{ brandName }}</strong>
          </div>

          <div class="mb-2">- Állapot: {{ instrument.condition }}</div>
          <div class="mb-2">- Részletek: {{ instrument.description }}</div>

          <hr />

          <RouterLink to="/app/instruments" class="btn btn-outline-secondary">
            Vissza a listához
          </RouterLink>
        </div>
      </div>
    </div>

    <div class="col-lg-5">
      <LendingForm
          :instrument="instrument"
          @create:lending="forwardCreate"
      />
    </div>
  </section>
</template>

<style scoped>

</style>
