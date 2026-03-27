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
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white">
    <div class="container">
      <RouterLink class="navbar-brand" to="/">Kölcsönző</RouterLink>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav ms-auto">
          <template v-for="r in routes" :key="r.name" >
            <li class="nav-item" v-if="!r.path.includes(':')">
              <RouterLink :to="{name: r.name}" class="nav-link" active-class="active">{{r.meta.title}}</RouterLink>
            </li>
          </template>
        </ul>
      </div>
    </div>
  </nav>
</template>

<style scoped>

</style>