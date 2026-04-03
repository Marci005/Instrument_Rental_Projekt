<script>
export default {
  name: "NotAuthorisedView"
}
</script>

<template>
  <div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
    <div class="card shadow-lg border-0" style="max-width: 480px; width: 100%;">
      <div class="card-body text-center p-4 p-md-5">
        <div class="mb-3">
          <span class="badge bg-danger rounded-pill px-3 py-2">
            403 – Nincs jogosultság
          </span>
        </div>

        <h1 class="h3 mb-3 fw-bold">
          Hoppá, ide nincs belépés!
        </h1>

        <p class="text-muted mb-4">
          Úgy tűnik, ehhez az oldalhoz nincs megfelelő jogosultságod.
          Ha szerinted ez hiba, vedd fel a kapcsolatot az adminisztrátorral.
        </p>

        <div class="d-grid gap-2">
          <button
              type="button"
              class="btn btn-primary"
              @click="$router.push({ name: 'home' })"
          >
            Vissza a főoldalra
          </button>

          <button
              type="button"
              class="btn btn-outline-secondary"
              @click="$router.back()"
          >
            Vissza az előző oldalra
          </button>
        </div>
      </div>

      <div class="card-footer text-center small text-muted bg-white border-0 pb-4">
        Ha úgy érzed, hogy ennek nem így kellene lennie, próbálj meg újra bejelentkezni.
      </div>
    </div>
  </div>
</template>

<style scoped>
.min-vh-100 {
  min-height: 100vh;
}
</style>
