<script>
import { useAuthStore } from "@/utils/authStore";
import { RouterLink, RouterView, useRouter } from "vue-router";

export default {
  name:"AppLayout",
  setup() {
    const auth = useAuthStore();
    const router = useRouter();

    async function logout() {
      await auth.logout();
      router.push('/');
    }

    return { logout };
  }
};
</script>

<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <RouterLink class="navbar-brand" to="/">Kölcsönző</RouterLink>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <RouterLink class="nav-link" to="/app/home">Kezdőlap</RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink class="nav-link" to="/app/instruments">Hangszerek</RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink class="nav-link" to="/app/lendings">Kölcsönzéseim</RouterLink>
            </li>
          </ul>

          <div class="d-flex gap-2">
            <button class="btn btn-danger btn-sm" @click="logout">Kijelentkezés</button>
          </div>
        </div>
      </div>
    </nav>

    <RouterView />
  </div>
</template>

