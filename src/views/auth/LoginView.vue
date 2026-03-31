<script>
import { http } from "@/utils/http.js";

export default {
  name: "LoginView",
  data() {
    return {
      form: { email: '', password: '' },
      error: null,
      loading: false
    }
  },
  methods: {
    async login() {
      this.error = null
      this.loading = true
      try {
        await http.get('/sanctum/csrf-cookie')
        await http.post('/login', this.form)
        this.$router.push('/home')
      } catch (e) {
        this.error = 'Hibás email vagy jelszó.'
      } finally {
        this.loading = false
      }
    }
  }
}
</script>

<template>
  <div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
    <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
      <h4 class="mb-4 text-center">Bejelentkezés</h4>

      <div v-if="error" class="alert alert-danger">{{ error }}</div>

      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" v-model="form.email" />
      </div>
      <div class="mb-3">
        <label class="form-label">Jelszó</label>
        <input type="password" class="form-control" v-model="form.password" />
      </div>
      <button class="btn btn-warning w-100" @click="login" :disabled="loading">
        {{ loading ? 'Bejelentkezés...' : 'Bejelentkezés' }}
      </button>
      <p class="text-center mt-3 mb-0 small">
        Még nincs fiókod?
        <RouterLink to="/register">Regisztrálj</RouterLink>
      </p>
    </div>
  </div>
</template>