<script>
import { RouterLink, RouterView, useRouter } from "vue-router";
import { http } from "@/utils/http.js";

export default {
  name: "AppLayout",
  components: { RouterLink, RouterView },
  data() {
    return {
      routes: [],
      categories: []
    }
  },
  methods: {
    getRoutesData() {
      this.routes = useRouter().getRoutes();
    },
    logout() {
      localStorage.removeItem('token')
      this.$router.push('/auth/login')
    }
  },
  async mounted() {
    this.getRoutesData();
    const response = await http.get('/categories')
    this.categories = response.data
  }
}
</script>

<template>
  <div class="layout">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <RouterLink class="navbar-brand" to="/home">Kölcsönző</RouterLink>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <RouterLink class="nav-link" to="/">Kezdőlap</RouterLink>
            </li>
            <li class="nav-item">
              <RouterLink class="nav-link" to="/instruments">Hangszerek</RouterLink>
              <!-- <ul class="dropdown-menu dropdown-menu-dark">
                   <li v-for="category in categories" :key="category.id">
                     <RouterLink class="dropdown-item" :to="`/instruments/${category.id}`">
                       {{ category.name }}
                     </RouterLink>
                   </li>
                   <li><hr class="dropdown-divider"></li>
                   <li><RouterLink class="dropdown-item" to="/instruments">Összes hangszer</RouterLink></li>
                 </ul>-->
               </li>
               <li class="nav-item">
                 <RouterLink class="nav-link" to="/rentals">Kölcsönzéseim</RouterLink>
               </li>
             </ul>
             <div class="d-flex gap-2">
               <button class="btn btn-outline-danger btn-sm" @click="logout">Kijelentkezés</button>
             </div>
           </div>
         </div>
       </nav>

       <div class="content-wrapper">

         <aside class="sidebar bg-dark border-end border-secondary">
           <ul class="nav flex-column p-3">
             <li class="nav-item" v-for="route in routes" :key="route.path">
               <RouterLink
                   v-if="route.meta?.sidebar"
                   class="nav-link text-secondary"
                   active-class="text-white"
                   :to="route.path"
               >
                 {{ route.meta.label ?? route.name }}
               </RouterLink>
             </li>
           </ul>
         </aside>

         <main class="page-content">
           <RouterView />
         </main>

       </div>

       <footer class="footer navbar-dark bg-dark border-top border-secondary">
         <div class="container-fluid d-flex justify-content-between align-items-center py-2 px-4">
           <span class="text-secondary small">© 2026 Kölcsönző</span>
           <span class="text-secondary small">Minden jog fenntartva</span>
         </div>
       </footer>

     </div>
   </template>

   <style scoped>
   .layout {
     display: flex;
     flex-direction: column;
     min-height: 100vh;
   }

   .navbar {
     width: 100%;
     position: sticky;
     top: 0;
     z-index: 1000;
   }

   .content-wrapper {
     display: flex;
     flex: 1;
   }

   .sidebar {
     width: 220px;
     min-height: 100%;
     flex-shrink: 0;
   }

   .page-content {
     flex: 1;
     padding: 1.5rem;
   }

   .footer {
     width: 100%;
   }
   </style>