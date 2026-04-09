<script>
import apiHandler from '../../utils/apiHandler';

export default {
  name:'register',
  data() {
    return {
      form:{
        email:'',
        password:'',
        password_confirmation:'',
        title:'',
        first_name:'',
        last_name:''
      }
    }
  },
  methods: {
    async register() {
      try {
        await apiHandler.csrf();
        const response = await apiHandler.register(JSON.stringify(this.form));
        console.log(response);

      } catch(err) {
        console.log(err.response.data.errors);
      } finally {

      }
    }
  }
}
</script>

<template>
  <form>
    <b class="d-block">Email cím</b>
    <input
        type="text" v-model="form.email"
        class="form-control form-control-sm"
    >

    <b class="d-block">Jelszó</b>
    <input
        type="password" v-model="form.password"
        class="form-control form-control-sm"
    >

    <b class="d-block">Jelszó újra</b>
    <input
        type="password" v-model="form.password_confirmation"
        class="form-control form-control-sm"
    >

    <b class="d-block">Megszólítás</b>
    <select v-model="form.title"
            class="form-control form-control-sm">
      <option value="-">válassz megszólítást</option>
      <option value="Úr">Úr</option>
      <option value="Hölgy">Hölgy</option>
      <option value="Dr">Dr</option>
      <option value="Prof">Prof</option>
    </select>

    <b class="d-block">Vezetéknév</b>
    <input
        type="text" v-model="form.first_name"
        class="form-control form-control-sm"
    >

    <b class="d-block">Keresztnév</b>
    <input
        type="text" v-model="form.last_name"
        class="form-control form-control-sm"
    >

    <button type="button" class="btn btn-primary btn-sm mt-2" @click="register()">
      Regisztráció
    </button>
  </form>
</template>

<style scoped>

</style>