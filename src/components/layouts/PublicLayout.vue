<script>
import { RouterLink, RouterView } from "vue-router";
import api from "@/utils/http.js";

export default {
  name: "PublicLayout",
  components: { RouterLink, RouterView },
  data() {
    return {
      categories: []
    }
  },
  async mounted() {
    try {
      const response = await api.get('api/instrument_categories')
      this.categories = response.data
    } catch (e) {
      console.warn('Kategóriák betöltése sikertelen')
    }
  }
}
</script>

<template>
  <div class="layout">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <RouterLink class="navbar-brand" to="/">Kölcsönző</RouterLink>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <RouterLink class="nav-link" to="/">Kezdőlap</RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink class="nav-link" to="/instruments">Hangszerek</RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink class="nav-link" to="/rentals">Kölcsönzéseim</RouterLink>
            </li>
          </ul>

          <div class="d-flex gap-2">
            <RouterLink class="btn btn-outline-light btn-sm" to="/auth/login">
              Bejelentkezés
            </RouterLink>

            <RouterLink class="btn btn-warning btn-sm" to="/auth/register">
              Regisztráció
            </RouterLink>
          </div>
        </div>
      </div>
    </nav>

    <main class="page-content">
      <RouterView />
    </main>
  </div>
</template>

<style scoped>
.layout {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

.navbar {
  width: 100%;
  position: sticky;
  top: 0;
  z-index: 1000;
}

.page-content {
  flex: 1;
}
</style>
