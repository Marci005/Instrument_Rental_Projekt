<script>
import AppLayout from "@/components/layouts/AppLayout.vue";
export default {
  name:"App",
  components: {AppLayout}
}
</script>

<template>
    <RouterView :instruments="instruments" :lendings="lendings"/>
</template>

<style scoped></style>
