<!--
  @file PublicLayout.vue
  @description Layout shell for unauthenticated (public) pages.

  Renders a sticky Bootstrap dark navbar with:
    - Brand link to the public home (/)
    - Nav links: Home, Instruments
    - "Login" and "Register" CTA buttons → /auth/login, /auth/register

  A <main class="page-content"> area below the navbar hosts the current
  public child view via <RouterView />.

  Used by the router for the '/' route group (HomeView, InstrumentsView).
-->
<script>
import { RouterLink, RouterView } from "vue-router";
import api from "@/utils/http.js";

export default {
  name: "PublicLayout",
  components: { RouterLink, RouterView },
}
</script>

<template>
  <!-- Outer flex-column wrapper stretches to full viewport height -->
  <div class="layout">

    <!-- Sticky top navbar — stays visible while the user scrolls -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">

        <!-- Brand / logo — links back to the public home page -->
        <RouterLink class="navbar-brand" to="/">Kölcsönző</RouterLink>

        <!-- Hamburger button shown on mobile (below lg breakpoint) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible nav content -->
        <div class="collapse navbar-collapse" id="nav">

          <!-- Left side: main navigation links -->
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <RouterLink class="nav-link" to="/">Kezdőlap</RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink class="nav-link" to="/instruments">Hangszerek</RouterLink>
            </li>
          </ul>

          <!-- Right side: auth action buttons -->
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

    <!-- Page content — renders whichever public child route is active -->
    <main class="page-content">
      <RouterView />
    </main>

  </div>
</template>

<style scoped>
/** Column flex so the layout fills at least the full viewport height. */
.layout {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

/** Sticky so the navbar stays at the top while scrolling page content. */
.navbar {
  width: 100%;
  position: sticky;
  top: 0;
  z-index: 1000;
}

/** Grows to fill all remaining space below the navbar. */
.page-content {
  flex: 1;
}
</style>
