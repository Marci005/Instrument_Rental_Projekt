<!--
  @file InstrumentCard.vue
  @description Reusable card that displays a single instrument summary.

  Shows:
    - Instrument title
    - Category and brand name (pre-resolved by the parent via client-side
      lookup — the API returns only category_id / brand_id foreign keys)
    - Monthly rental price and deposit amount
    - "Kölcsönzöm" button that navigates to the instrument detail page

  Props:
    instrument {Object} — enriched instrument object; must contain:
      id, title, category_name, brand_name, monthly_price, deposit.

  The parent (InstrumentsView) is responsible for attaching category_name
  and brand_name by looking them up in the separate categories/brands API
  responses before passing the object down here.
-->
<script>
export default {
  name: "InstrumentCard",
  props: {
    /**
     * Full instrument object enriched with category_name and brand_name.
     * Required — the card cannot render meaningful content without it.
     */
    instrument: { type: Object, required: true }
  }
}
</script>

<template>
  <div class="card">
    <div class="card-body">

      <!-- Instrument display name -->
      <h5 class="card-title mb-1">{{ instrument.title }}</h5>

      <!-- Category and brand resolved by the parent component -->
      <div class="text-muted mb-3">
        Kategória: {{ instrument.category_name }}<br>
        Márka: {{ instrument.brand_name }}
      </div>

      <!-- Pricing info -->
      <div class="d-flex flex-wrap gap-2 mb-3">
        <span>Havi díj: {{ instrument.monthly_price }} Ft</span>
        <span class="text-muted">Kaució: {{ instrument.deposit }} Ft</span>
      </div>

      <!--
        CTA button — navigates programmatically to the instrument detail page.
        Uses a template literal to build the /app/instruments/:id path.
      -->
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
