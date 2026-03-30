<script>
import {RouterLink, RouterView} from "vue-router";

export default {
  name: "PublicLayout",
  components: {
    RouterLink,
    RouterView
  }
}
</script>

<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white">
    <div class="container">
      <RouterLink class="navbar-brand" to="/">Kölcsönző</RouterLink>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <RouterLink class="nav-link" to="/home">Kezdőlap</RouterLink>
          </li>
          <li class="nav-item">
            <RouterLink class="nav-link" to="/instruments">Hangszerek</RouterLink>
          </li>
          <li class="nav-item">
            <RouterLink class="nav-link" to="/instruments">Kölcsönzéseim</RouterLink>
          </li>
        </ul>
        <div class="d-flex gap-2">
          <RouterLink class="btn btn-outline-light btn-sm" to="/auth/login">Bejelentkezés</RouterLink>
          <RouterLink class="btn btn-warning btn-sm" to="/register">Regisztráció</RouterLink>
        </div>
      </div>
    </div>
  </nav>
</template>

<style scoped>

</style>