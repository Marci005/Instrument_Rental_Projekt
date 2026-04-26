<!--
  @file LoginView.vue
  @description Login form for existing users.

  Renders a centred Bootstrap card with an email + password form.
  On submit, delegates to the Pinia auth store's login() action which:
    - fetches the CSRF cookie
    - POSTs credentials to /api/login
    - fetches the user profile from /api/me
    - redirects based on role (admin → /admin/users, normal → /app/home)

  If login() throws (wrong credentials / network error), a generic error
  message is shown. Field-level errors from Laravel are handled by the store
  but not currently displayed here — only the generic message is shown.

  The component also sets its own local loading/error state so the button
  can be disabled during the async call and the error message can be cleared
  on each new attempt.
-->
<script>
import { useAuthStore } from "@/utils/authStore";

export default {
  name: "LoginView",
  data() {
    return {
      form: { email: '', password: '' }, // Bound to the two input fields via v-model
      error:   null,   // Generic error string shown in the alert box
      loading: false   // True while the auth store login() call is in progress
    }
  },
  methods: {
    /**
     * Handles form submission.
     * Clears the previous error, sets loading, then calls auth.login().
     * The store itself handles navigation on success.
     * On failure, shows a generic "wrong credentials" message.
     */
    async login() {
      this.error   = null;
      this.loading = true;

      const auth = useAuthStore();

      try {
        await auth.login(this.form);
        /** Navigation is handled inside auth.login() — no push needed here. */
        this.$router.push({ name: 'app-home' });
      } catch (e) {
        console.error(e);
        this.error = 'Hibás email vagy jelszó.';
      } finally {
        this.loading = false;
      }
    }
  }
}
</script>

<template>
  <!-- Full-viewport centred container (AuthLayout already centres, this is a fallback) -->
  <div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
    <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
      <h4 class="mb-4 text-center">Bejelentkezés</h4>

      <!-- Error alert — only rendered when this.error is set -->
      <div v-if="error" class="alert alert-danger">
        {{ error }}
      </div>

      <!-- Email field -->
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input
            type="email"
            class="form-control"
            v-model="form.email"
        >
      </div>

      <!-- Password field -->
      <div class="mb-3">
        <label class="form-label">Jelszó</label>
        <input
            type="password"
            class="form-control"
            v-model="form.password"
        >
      </div>

      <!--
        Submit button.
        Disabled while loading to prevent double-submission.
        Label changes to reflect the in-progress state.
      -->
      <button
          class="btn btn-warning w-100"
          @click="login"
          :disabled="loading"
      >
        {{ loading ? 'Bejelentkezés...' : 'Bejelentkezés' }}
      </button>

      <!-- Link to the registration page for new users -->
      <p class="text-center mt-3 mb-0 small">
        Nincs még fiókod?
        <RouterLink to="/auth/register">Regisztráció</RouterLink>
      </p>
    </div>
  </div>
</template>

<style scoped>
</style>
