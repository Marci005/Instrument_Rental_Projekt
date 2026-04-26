<!--
  @file HomeView.vue
  @description Public and authenticated home / landing page.

  Used by both the public route (/) and the authenticated route (/app/home)
  because the content is mostly the same — only the CTA button targets differ.
  The isLoggedIn flag read from the Pinia auth store controls which URL each
  button points to so authenticated users stay inside the /app route group.

  Sections:
    1. Hero   — full-viewport background image with a headline and a "Browse" CTA.
    2. Features — three feature boxes (selection, speed, quality).
    3. CTA strip — "Ready to play?" call-to-action with a Register / My Account button.
-->
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
        <!--
          "Browse instruments" CTA.
          Logged-in users go to the authenticated instrument list (/app/instruments)
          so the AppLayout navbar is shown. Guests go to the public list (/instruments).
        -->
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

          <!-- Feature 1: Wide selection -->
          <div class="col-md-4">
            <div class="feature-box p-4 text-center shadow-sm rounded">
              <i class="bi bi-music-note-beamed fs-1 text-warning"></i>
              <h4 class="mt-3">Széles választék</h4>
              <p>Klasszikus, modern és ritka hangszerek egy helyen.</p>
            </div>
          </div>

          <!-- Feature 2: Fast rental process -->
          <div class="col-md-4">
            <div class="feature-box p-4 text-center shadow-sm rounded">
              <i class="bi bi-lightning-charge-fill fs-1 text-warning"></i>
              <h4 class="mt-3">Gyors kölcsönzés</h4>
              <p>Egyszerű foglalás, azonnali visszaigazolás.</p>
            </div>
          </div>

          <!-- Feature 3: Reliable quality -->
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
        <!--
          Secondary CTA button.
          Logged-in users see "Fiókom" → /app/home.
          Guests see "Regisztráció" → /auth/register.
        -->
        <router-link
            :to="isLoggedIn ? '/app/home' : '/auth/register'"
            class="btn btn-warning btn-lg px-4 py-2 fw-semibold"
        >
          {{ isLoggedIn ? 'Fiókom' : 'Regisztráció' }}
        </router-link>
      </div>
    </section>

  </div>
</template>

<style scoped>
/**
 * Hero section — full-viewport background image from Unsplash.
 * A dark overlay (::before pseudo-element) ensures the white text
 * is readable regardless of the image content.
 */
.hero {
  position: relative;
  min-height: 70vh;
  background: url('https://images.unsplash.com/photo-1511379938547-c1f69419868d') center/cover no-repeat;
}

/** Dark semi-transparent overlay covering the entire hero image. */
.hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.55);
}

/** Keeps hero text above the overlay (z-index > the ::before pseudo-element). */
.hero .container {
  position: relative;
  z-index: 2;
}

/** Subtle lift + shadow on hover to make feature boxes feel interactive. */
.feature-box {
  transition: transform .2s ease, box-shadow .2s ease;
}

.feature-box:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}
</style>
