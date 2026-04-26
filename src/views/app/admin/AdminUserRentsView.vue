<!--
  @file AdminUserRentsView.vue
  @description Admin page — shows all rentals belonging to a specific user.

  Reads the :id route param to identify the user, then fetches the user profile
  and their rental list in parallel with Promise.all for efficiency.
  Displays the rentals in a striped table with a delete action per row.

  Admins can delete any user's rental from this page. On deletion the row is
  immediately removed from the local array — no full reload is needed.

  The "back" button navigates to admin-users (the full user list).
-->
<script setup>
import { ref, onMounted, computed } from "vue";
import { useRoute, useRouter } from "vue-router";
import apiHandler from "@/utils/apiHandler";

const route  = useRoute();
const router = useRouter();

/** User id extracted from the :id route parameter. */
const userId = route.params.id;

/** Reactive refs for the user profile, their rental list, and UI state. */
const user    = ref(null);
const rents   = ref([]);
const loading = ref(true);
const error   = ref(null);

/**
 * Full name computed from first_name + last_name.
 * Returns an empty string while the user profile is still loading.
 */
const userFullName = computed(() => {
  if (!user.value) return '';
  return `${user.value.first_name} ${user.value.last_name}`;
});

/**
 * Loads the user profile and their rentals in parallel.
 * Using Promise.all means both requests are sent simultaneously,
 * which is faster than awaiting them sequentially.
 */
async function loadData() {
  loading.value = true;
  error.value   = null;

  try {
    const [userRes, rentsRes] = await Promise.all([
      apiHandler.get(`/api/users/${userId}`),
      apiHandler.get(`/api/users/${userId}/rents`),
    ]);
    user.value  = userRes.data;
    rents.value = rentsRes.data;
  } catch (err) {
    error.value = "Nem sikerült betölteni az adatokat.";
  } finally {
    loading.value = false;
  }
}

/**
 * Deletes a rental after a confirmation dialog.
 * Admins can delete any rental regardless of which user owns it.
 * On success, filters the deleted rental out of the local array.
 *
 * @param {Object} rent  The rental row object.
 */
async function deleteRent(rent) {
  const instrumentTitle = rent.instrument?.title || 'ismeretlen hangszer';
  if (!confirm(`Biztos törlöd ezt a kölcsönzést? (${instrumentTitle})`)) return;

  try {
    await apiHandler.delete(`/api/rents/${rent.id}`);
    /** Remove the deleted rent from the array so the table updates instantly. */
    rents.value = rents.value.filter(r => r.id !== rent.id);
  } catch {
    alert("Nem sikerült törölni a kölcsönzést.");
  }
}

/**
 * Formats an ISO date string into the Hungarian short date format (YYYY.MM.DD.).
 * Returns '—' for null/undefined input.
 *
 * @param {string|null} isoString
 * @returns {string}
 */
function formatDate(isoString) {
  if (!isoString) return '—';
  const date = new Date(isoString);
  if (isNaN(date.getTime())) return isoString;
  return date.toLocaleDateString('hu-HU', {
    year:  'numeric',
    month: '2-digit',
    day:   '2-digit',
  });
}

/** Navigates back to the full user list page. */
function goBack() {
  router.push({ name: 'admin-users' });
}

onMounted(() => {
  loadData();
});
</script>

<template>
  <div class="admin-page">

    <!-- Back navigation button -->
    <button class="btn btn-outline-secondary mb-3" @click="goBack">
      ← Vissza a felhasználókhoz
    </button>

    <!-- Loading spinner -->
    <div v-if="loading" class="text-center">
      <div class="spinner-border"></div>
      <p>Betöltés...</p>
    </div>

    <!-- Error state -->
    <div v-else-if="error" class="alert alert-danger">{{ error }}</div>

    <!-- Content — only shown after successful data load -->
    <template v-else>

      <!-- Page heading shows the user's name and email -->
      <h1 class="mb-4">
        Kölcsönzések – <span class="text-primary">{{ userFullName }}</span>
        <small class="text-muted">({{ user?.email }})</small>
      </h1>

      <!-- Empty state — user has no rentals -->
      <div v-if="rents.length === 0" class="alert alert-info">
        Ennek a felhasználónak még nincs kölcsönzése.
      </div>

      <!-- Rental table -->
      <table v-else class="table table-striped table-bordered align-middle">
        <thead>
        <tr>
          <th>ID</th>
          <th>Hangszer</th>
          <th>Kezdő dátum</th>
          <th>Záró dátum</th>
          <th>Tényleges vége</th>   <!-- real_end_date: set when returned early -->
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
          <!-- real_end_date is null unless the user returned the instrument early -->
          <td>{{ formatDate(rent.real_end_date) }}</td>
          <td>{{ rent.rent_price?.toLocaleString('hu-HU') || 0 }} Ft</td>
          <td>
            <!-- Delete button — removes the rent after confirmation -->
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
