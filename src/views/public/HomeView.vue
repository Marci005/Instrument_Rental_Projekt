<script>
import { useAuthStore } from "@/utils/authStore";

export default {
  name: "HomeView",

  setup() {
    const auth = useAuthStore();

    /**
     * Snapshot of login state taken at render time.
     * A computed ref is not needed here because the component re-mounts
     * when the user logs in/out (the router changes the active component).
     */
    const isLoggedIn = !!auth.user;

    return { isLoggedIn };
  }
}
</script>

<template>
  <div class="home-container">

    <!-- ── HERO SECTION ───────────────────────────────────────────────────── -->
    <section class="hero d-flex align-items-center text-center text-white">
      <div class="container">
        <h1 class="display-3 fw-bold mb-3">Hangszerek, amiket imádni fogsz</h1>
        <p class="lead mb-4">
          Bérelj profi hangszereket gyorsan és megfizethető áron.
        </p>
        <RouterLink
            :to="isLoggedIn ? '/app/instruments' : '/instruments'"
            class="btn btn-warning btn-lg px-4 py-2 fw-semibold"
        >
          Böngéssz hangszereket
        </RouterLink>
      </div>
    </section>

    <!-- ── FEATURES SECTION ───────────────────────────────────────────────── -->
    <section class="py-5 bg-light">
      <div class="container">
        <div class="row g-4">

          <div class="col-md-4">
            <div class="feature-box p-4 text-center shadow-sm rounded">
              <i class="bi bi-music-note-beamed fs-1 text-warning"></i>
              <h4 class="mt-3">Széles választék</h4>
              <p>Klasszikus, modern és ritka hangszerek egy helyen.</p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="feature-box p-4 text-center shadow-sm rounded">
              <i class="bi bi-lightning-charge-fill fs-1 text-warning"></i>
              <h4 class="mt-3">Gyors kölcsönzés</h4>
              <p>Egyszerű foglalás, azonnali visszaigazolás.</p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="feature-box p-4 text-center shadow-sm rounded">
              <i class="bi bi-shield-check fs-1 text-warning"></i>
              <h4 class="mt-3">Megbízható minőség</h4>
              <p>Minden hangszer karbantartva és ellenőrizve.</p>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- ── BOTTOM CTA SECTION ─────────────────────────────────────────────── -->
    <section class="py-5 text-center">
      <div class="container">
        <h2 class="fw-bold mb-3">Készen állsz a zenére?</h2>
        <p class="lead mb-4">Regisztrálj és kezdj el hangszereket kölcsönözni még ma.</p>
        <RouterLink
            to="/auth/register"
            class="btn btn-warning btn-lg px-4 py-2 fw-semibold"
        >
          Regisztráció
        </RouterLink>
      </div>
    </section>

  </div>
</template>

<style scoped>
.hero {
  position: relative;
  min-height: 70vh;
  background: url('https://images.unsplash.com/photo-1511379938547-c1f69419868d') center/cover no-repeat;
}

.hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.55);
}

.hero .container {
  position: relative;
  z-index: 2;
}

.feature-box {
  background-color: #1d1917;
  border: 1px solid rgba(245, 240, 232, 0.08);
  color: #f5f0e8;
}
</style>
