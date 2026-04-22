<script>
export default {
  name: "SettingsView",
  data(){
    return{
      email: 'user@example.com',
      newsletter: true
    }
  }
}
</script>

<template>
  <section class="card">
    <div class="card-body">
      <h1 class="h4">Settings</h1>
      <div class="row g-3">
        <form>
          <div class="col-12 col-md-6">
            <label for="email" class="form-label">Email</label>
            <input id="email" v-model="email" type="email" class="form-control">
          </div>
          <div class="col-12">
            <div class="form-check">
              <input type="checkbox" id="newsletter" v-model="newsletter" class="form-check-input">
              <label for="newsletter" class="form-check-label">Newsletter</label>
            </div>
          </div>
        </form>
      </div>
      <hr>
      <button type="button" class="btn btn-primary">Save</button>
    </div>
  </section>
</template>

<style scoped>

</style>