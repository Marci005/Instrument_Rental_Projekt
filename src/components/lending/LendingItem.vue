<script>
export default {
  name: "LendingItem",
  props: {
    lending: {type: Object, required: true, default: null},
  },
  emits:['update', 'remove'],
  data() {
    return {
      isEditing: false,
      edit: {start_date: '', end_date: ''}
    }
  },
  methods:{
    startEdit(){
      this.isEditing = true;
      this.edit = {
        start_date: this.lending.start_date,
        end_date: this.lending.end_date,
      }
    },
    cancel(){
      this.isEditing = false;
    },
    save() {
      if (!this.edit.start_date || !this.edit.end_date) return

      this.$emit('update', {
        ...this.lending,
        start_date: this.edit.start_date,
        end_date: this.edit.end_date,
      })
      this.isEditing = false
    }
  }
}
</script>

<template>
  <div class="list-group-item">
    <div class="d-flex justify-content-between align-items-start gap-3">
      <div class="flex-grow-1">
        <div class="fw-semibold">{{ lending.instrumentName }}</div>
        <div class="text-muted small">
          {{lending.start_date }} -tól/től • {{ lending.end_date }} -ig • {{ lending.customerName }}
        </div>

        <div v-if="isEditing" class="mt-3 border rounded p-3 bg-light">
          <div class="row g-2">
            <div class="col-md-4">
              <label class="form-label small">Kezdő dátum</label>
              <input v-model="edit.start_date" type="date" class="form-control form-control-sm"/>
            </div>
            <div class="col-md-4">
              <label class="form-label small">Záró dátum</label>
              <input v-model="edit.end_date" type="date" class="form-control form-control-sm"/>
            </div>
          </div>

          <div class="d-flex gap-2 mt-2">
            <button class="btn btn-sm btn-success" @click="save">Mentés</button>
            <button class="btn btn-sm btn-outline-secondary" @click="cancel">Mégse</button>
          </div>
        </div>
      </div>

      <div class="d-flex flex-column gap-2">
        <button class="btn btn-sm btn-outline-primary" @click="startEdit" :disabled="isEditing">
          Módosít
        </button>
        <button class="btn btn-sm btn-outline-danger" @click="$emit('remove', lending.id)">
          Töröl
        </button>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>