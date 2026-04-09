<script>
export default {
  name: "AuthLayout"
}
</script>

<template>
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
  background: #f8f9fa;
}
</style>
