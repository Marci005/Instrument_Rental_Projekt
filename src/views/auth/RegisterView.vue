<!--
  @file RegisterView.vue
  @description Registration form for new users.

  Collects: email, password, password confirmation, title (salutation),
  first name and last name. On submit, calls apiHandler.register() directly,
  then redirects to /auth/login on success.

  Note: this component calls apiHandler directly instead of going through the
  Pinia auth store. As a result, it does not auto-login after registration —
  the user is sent to the login page instead. This is different from the store's
  register() action which logs the user in immediately after registration.
  Consider refactoring to use the store for consistency.
-->
<script>
import apiHandler from '../../utils/apiHandler';

export default {
  name:'register',
  data() {
    return {
      form:{
        email:                 '',
        password:              '',
        password_confirmation: '',  // Must match password (Laravel `confirmed` rule)
        title:                 '',  // Salutation: Úr, Hölgy, Dr., Professzor
        first_name:            '',
        last_name:             ''
      }
    }
  },
  methods: {
    /**
     * Handles the Register button click.
     * Fetches the CSRF cookie, posts the form data to /api/register,
     * then navigates to the login page on success.
     * Logs validation errors to the console (not yet shown in the UI).
     */
    async register() {
      try {
        await apiHandler.csrf();

        const response = await apiHandler.register(this.form);

        console.log("Sikeres regisztráció:", response);

        /** Redirect to login so the user can authenticate with their new account. */
        this.$router.push('/auth/login');

      } catch (err) {
        /**  display field-level errors in the UI instead of only logging them. */
        console.log(err.response?.data?.errors);
      }
    }
  }
}
</script>

<template>
  <form>

    <!-- Email address -->
    <b class="d-block">Email cím</b>
    <input
        type="text" v-model="form.email"
        class="form-control form-control-sm"
    >

    <!-- Password -->
    <b class="d-block">Jelszó</b>
    <input
        type="password" v-model="form.password"
        class="form-control form-control-sm"
    >

    <!-- Password confirmation — must equal form.password (backend validates this) -->
    <b class="d-block">Jelszó újra</b>
    <input
        type="password" v-model="form.password_confirmation"
        class="form-control form-control-sm"
    >

    <!-- Salutation / title dropdown -->
    <b class="d-block">Megszólítás</b>
    <select v-model="form.title"
            class="form-control form-control-sm">
      <option disabled value="">válassz megszólítást</option>
      <option value="Úr">Úr</option>
      <option value="Hölgy">Hölgy</option>
      <option value="Dr.">Dr.</option>
      <option value="Professzor">Professzor</option>
    </select>

    <!-- First name (vezetéknév = family name in Hungarian) -->
    <b class="d-block">Vezetéknév</b>
    <input
        type="text" v-model="form.first_name"
        class="form-control form-control-sm"
    >

    <!-- Last name (keresztnév = given name in Hungarian) -->
    <b class="d-block">Keresztnév</b>
    <input
        type="text" v-model="form.last_name"
        class="form-control form-control-sm"
    >

    <!-- Submit — type="button" prevents accidental native form submission -->
    <button type="button" class="btn btn-primary btn-sm mt-2" @click="register()">
      Regisztráció
    </button>

  </form>
</template>

<style scoped>
</style>
