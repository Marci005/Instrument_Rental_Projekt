<!--
  @file LendingView.vue
  @description Page-level wrapper for the "My Rentals" section (/app/lendings).

  A thin shell that renders a section heading and delegates all data loading
  and display logic to the <LendingList> component. Keeping this layer
  separate allows the router to point to LendingView while LendingList
  stays reusable in other contexts if needed.
-->
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
    <!-- LendingList handles fetching, loading state, and rendering rental cards -->
    <LendingList />
  </section>
</template>

<style scoped>
</style>
