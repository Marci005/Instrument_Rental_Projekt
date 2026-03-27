<script>
import AppLayout from "@/components/layouts/AppLayout.vue";
export default {
  name:"App",
  components: {AppLayout}
}
</script>

<template>
  <AppLayout/>
  <main class="container my-4">
    <RouterView :instruments="instruments" :lendings="lendings"/>
  </main>

</template>

<style scoped></style>
