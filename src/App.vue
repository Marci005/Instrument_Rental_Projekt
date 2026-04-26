<!--
  @file App.vue
  @description Root component of the Vue 3 application.

  Intentionally minimal — its only job is to render <RouterView />, which
  displays the layout component (PublicLayout, AuthLayout, AppLayout or
  AdminLayout) matched by the current URL. All real UI lives inside those
  layouts and their child view components.
-->
<script>
export default {
  name: "App"
}
</script>

<template>
  <!-- Top-level router outlet — renders the layout matched by the current route -->
  <RouterView />
</template>

<style scoped></style>
