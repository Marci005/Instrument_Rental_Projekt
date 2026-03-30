<script>
import {RouterLink, useRouter} from "vue-router";

export default {
  name: "AppLayout",
  components: {
    RouterLink
  },
  data() {
    return {
      routes: [],
    }
  },
  methods:{
    getRoutesData(){
      this.routes = useRouter().getRoutes();
    }
  },
  mounted() {
    this.getRoutesData();
  }
}
</script>

<template>

</template>

<style scoped>

</style>