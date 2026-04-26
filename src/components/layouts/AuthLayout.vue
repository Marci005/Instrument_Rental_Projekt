<!--
  @file AuthLayout.vue
  @description Layout shell for authentication pages (Login, Register).

  Provides a full-viewport centred container with a light background.
  The child view (login / register form card) is rendered via <RouterView />.

  No navbar is rendered here intentionally — auth pages stand alone so the
  user focuses solely on the form without navigation distractions.
-->
<script>
export default {
  name: "AuthLayout"
}
</script>

<template>
  <!--
    auth-layout:
      min-height: 100vh  — stretches to fill the full viewport height
      display: flex      — flexbox so justify/align-items work
      justify-content    — centres child horizontally
      align-items        — centres child vertically
  -->
  <div class="auth-layout">
    <RouterView />
  </div>
</template>

<style scoped>
.auth-layout {
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #f8f9fa; /* Bootstrap $gray-100 — neutral light background */
}
</style>
