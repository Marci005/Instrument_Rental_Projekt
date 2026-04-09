<script >
export default {
  name:"InstrumentCard",
  props:{
    instrument:{type:Object, required: true , default: null}
  }
}
</script>

<template>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title mb-1">{{instrument.name}}</h5>
      <div class="text-muted mb-3">
        - Kategória: {{ instrument.category }} - Márka: {{ instrument.brand }}
      </div>
      <div class="d-flex flex-wrap gap-2 mb-3">
        <span>{{instrument.price}}</span>
      </div>
      <button type="button" class="btn btn-success w-100" @click="$emit('select', instrument.id)">Kölcsönzöm</button>
    </div>
  </div>
</template>
<style scoped>

</style>