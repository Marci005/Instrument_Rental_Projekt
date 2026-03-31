<script>
import { RouterLink, RouterView } from "vue-router";
import { http } from "@/utils/http.js";

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
      const response = await http.get('/instrument-categories')
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
              <RouterLink class="nav-link" to="/home">Kezdőlap</RouterLink>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                Hangszerek
              </a>
              <ul class="dropdown-menu dropdown-menu-dark">
                <li v-for="category in categories" :key="category.id">
                  <RouterLink class="dropdown-item" :to="`/instruments/${category.id}`">
                    {{ category.name }}
                  </RouterLink>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li><RouterLink class="dropdown-item" to="/instruments">Összes hangszer</RouterLink></li>
              </ul>
            </li>
            <li class="nav-item">
              <RouterLink class="nav-link" to="/rentals">Kölcsönzéseim</RouterLink>
            </li>
          </ul>
          <div class="d-flex gap-2">
            <RouterLink class="btn btn-outline-light btn-sm" to="/auth/login">Bejelentkezés</RouterLink>
            <RouterLink class="btn btn-warning btn-sm" to="/register">Regisztráció</RouterLink>
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