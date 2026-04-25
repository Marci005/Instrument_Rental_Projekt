<script setup>
import { ref, onMounted, computed } from "vue";
import { useRoute, useRouter } from "vue-router";
import apiHandler from "@/utils/apiHandler";

const route = useRoute();
const router = useRouter();

const userId = route.params.id;

const user = ref(null);
const rents = ref([]);
const loading = ref(true);
const error = ref(null);

const userFullName = computed(() => {
  if (!user.value) return '';
  return `${user.value.first_name} ${user.value.last_name}`;
});

/**
 * Loads the user profile and their rents in parallel.
 */
async function loadData() {
  loading.value = true;
  error.value = null;

  try {
    const [userRes, rentsRes] = await Promise.all([
      apiHandler.get(`/api/users/${userId}`),
      apiHandler.get(`/api/users/${userId}/rents`),
    ]);
    user.value = userRes.data;
    rents.value = rentsRes.data;
  } catch (err) {
    error.value = "Nem sikerült betölteni az adatokat.";
  } finally {
    loading.value = false;
  }
}

/**
 * Deletes a rent after confirmation. Admins can delete any user's rents.
 */
async function deleteRent(rent) {
  const instrumentTitle = rent.instrument?.title || 'ismeretlen hangszer';
  if (!confirm(`Biztos törlöd ezt a kölcsönzést? (${instrumentTitle})`)) return;

  try {
    await apiHandler.delete(`/api/rents/${rent.id}`);
    rents.value = rents.value.filter(r => r.id !== rent.id);
  } catch {
    alert("Nem sikerült törölni a kölcsönzést.");
  }
}

/**
 * Formats an ISO date string as Hungarian short date (YYYY.MM.DD.).
 */
function formatDate(isoString) {
  if (!isoString) return '—';
  const date = new Date(isoString);
  if (isNaN(date.getTime())) return isoString;
  return date.toLocaleDateString('hu-HU', {
    year: 'numeric',
    month: '2-digit',
    day: '2-digit',
  });
}

function goBack() {
  router.push({ name: 'admin-users' });
}

onMounted(() => {
  loadData();
});
</script>

<template>
  <div class="admin-page">

    <button class="btn btn-outline-secondary mb-3" @click="goBack">
      ← Vissza a felhasználókhoz
    </button>

    <div v-if="loading" class="text-center">
      <div class="spinner-border"></div>
      <p>Betöltés...</p>
    </div>

    <div v-else-if="error" class="alert alert-danger">{{ error }}</div>

    <template v-else>
      <h1 class="mb-4">
        Kölcsönzések – <span class="text-primary">{{ userFullName }}</span>
        <small class="text-muted">({{ user?.email }})</small>
      </h1>

      <div v-if="rents.length === 0" class="alert alert-info">
        Ennek a felhasználónak még nincs kölcsönzése.
      </div>

      <table v-else class="table table-striped table-bordered align-middle">
        <thead>
        <tr>
          <th>ID</th>
          <th>Hangszer</th>
          <th>Kezdő dátum</th>
          <th>Záró dátum</th>
          <th>Tényleges vége</th>
          <th>Bérleti díj</th>
          <th>Műveletek</th>
        </tr>
        </thead>

        <tbody>
        <tr v-for="rent in rents" :key="rent.id">
          <td>{{ rent.id }}</td>
          <td>{{ rent.instrument?.title || '—' }}</td>
          <td>{{ formatDate(rent.start_date) }}</td>
          <td>{{ formatDate(rent.end_date) }}</td>
          <td>{{ formatDate(rent.real_end_date) }}</td>
          <td>{{ rent.rent_price?.toLocaleString('hu-HU') || 0 }} Ft</td>
          <td>
            <button class="btn btn-sm btn-danger" @click="deleteRent(rent)">
              Törlés
            </button>
          </td>
        </tr>
        </tbody>
      </table>
    </template>

  </div>
</template>

<style scoped>
.admin-page {
  padding: 20px;
}
</style>
