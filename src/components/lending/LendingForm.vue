<script>
export default {
  name: "LendingForm",
  props: {
    instrument: {type: Object, required: true, default: null},
  },
  emits:['create:lending'],
  data() {
    return {
      customerName: '',
      start_date: '',
      end_date:'',
    }
  },
  methods: {
    submit() {
      if (!this.customerName || !this.start_date || !this.end_date) {
        return;
      }
      this.$emit('create:lending', {
        instrumentId: this.instrument.id,
        start_date: this.start_date,
        end_date: this.end_date,
        customerName: this.customerName,
      });
      this.customerName = '';
      this.start_date = '';
      this.end_date = '';
    }
  }
}
</script>

<template>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Kölcsönzés</h5>
      <form @submit.prevent="submit">
        <div class="mb-3">
          <label class="form-label" for="customerName">Név</label>
          <input type="text" class="form-control" id="customerName" v-model.trim="customerName" required />
        </div>
        <div class="mb-3">
          <label class="form-label" for="date">Kölcsönzés hossza</label>
          <input type="date" class="form-control" id="date" v-model="start_date" required />
          <input type="date" class="form-control" id="date" v-model="end_date" required />
        </div>a
        <input type="submit" class="btn btn-primary w-100" value="Kölcsönzés">
      </form>
    </div>
  </div>
</template>

<style scoped>

</style>