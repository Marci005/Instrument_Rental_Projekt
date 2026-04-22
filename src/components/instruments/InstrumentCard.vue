<script>
export default {
  name: "InstrumentCard",
  props: {
    instrument: { type: Object, required: true }
  }
}
</script>

<template>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title mb-1">{{ instrument.title }}</h5>
      <div class="text-muted mb-3">
        Kategória: {{ instrument.category_name }}<br>
        Márka: {{ instrument.brand_name }}
      </div>
      <div class="d-flex flex-wrap gap-2 mb-3">
        <span>Havi díj: {{ instrument.monthly_price }} Ft</span>
        <span class="text-muted">Kaució: {{ instrument.deposit }} Ft</span>
      </div>
      <button
          type="button"
          class="btn btn-success w-100"
          @click="$router.push(`/app/instruments/${instrument.id}`)"
      >
        Kölcsönzöm
      </button>

    </div>
  </div>
</template>