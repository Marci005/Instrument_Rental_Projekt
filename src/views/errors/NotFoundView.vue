<!--
  @file NotFoundView.vue
  @description 404 error page — shown when no route matches the current URL.

  Mapped to the catch-all route '/:pathMatch(.*)*' in the router so any
  unrecognised URL renders this page instead of a blank screen.

  Two navigation options:
    - "Vissza a főoldalra" → pushes the user to the named 'home' route
    - "Vissza az előző oldalra" → calls $router.back() (browser history)
-->
<script>
export default {
  name: "NotFoundView"
}
</script>

<template>
  <!-- Full-viewport centred container — same pattern as AuthLayout -->
  <div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
    <div class="card shadow-lg border-0" style="max-width: 480px; width: 100%;">
      <div class="card-body text-center p-4 p-md-5">

        <!-- Warning icon -->
        <div class="mb-3">
          <i class="bi bi-exclamation-triangle-fill text-warning" style="font-size: 3rem;"></i>
        </div>

        <!-- HTTP status badge -->
        <div class="mb-3">
          <span class="badge bg-warning text-dark rounded-pill px-3 py-2">
            404 – Az oldal nem található
          </span>
        </div>

        <h1 class="h3 mb-3 fw-bold">
          Hoppá, ez az oldal nem létezik
        </h1>

        <p class="text-muted mb-4">
          Lehet, hogy az oldal át lett helyezve, törölték,
          vagy soha nem is létezett.
        </p>

        <!-- Navigation buttons stacked vertically (d-grid) -->
        <div class="d-grid gap-2">
          <!-- Navigates to the public home page -->
          <button
              type="button"
              class="btn btn-primary"
              @click="$router.push({ name: 'home' })"
          >
            Vissza a főoldalra
          </button>

          <!-- Goes back one step in browser history -->
          <button
              type="button"
              class="btn btn-outline-secondary"
              @click="$router.back()"
          >
            Vissza az előző oldalra
          </button>
        </div>

      </div>

      <!-- Footer hint -->
      <div class="card-footer text-center small text-muted bg-white border-0 pb-4">
        Ha szerinted ez hiba, frissítsd az oldalt vagy ellenőrizd az URL-t.
      </div>
    </div>
  </div>
</template>

<style scoped>
.min-vh-100 {
  min-height: 100vh;
}
</style>
