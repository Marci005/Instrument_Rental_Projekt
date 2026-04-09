<script>
import LendingItem from "@/components/lending/LendingItem.vue";
export default {
  name: "LendingList",
  components: {LendingItem},
  props: {
    lendings: {type: Array, required: true, default: () => []},
  },
  emits: ["update",'remove'],
}
</script>

<template>
  <div class="list-group">
    <LendingItem v-for="b in lendings" :key="b.id" :lending="b" @update="$emit('update',$event)" @remove="$emit('remove',$event)"
    />
  </div>
</template>

<style scoped>

</style>