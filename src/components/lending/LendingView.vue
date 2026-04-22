<script>
import LendingList from "./LendingList.vue";

export default {
  name: "LendingView",
  components: { LendingList }
};
</script>

<template>
  <section class="page-content">
    <h2>Kölcsönzéseim</h2>
    <LendingList />
  </section>
</template>

<style scoped>
</style>
