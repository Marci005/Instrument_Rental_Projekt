<script setup>
import { ref, onMounted } from "vue";
import apiHandler from "@/utils/apiHandler";

// Form fields
const categoryId = ref('');
const brandId = ref('');
const condition = ref('Új');
const title = ref('');
const description = ref('');
const monthlyPrice = ref(0);
const deposit = ref(0);
const imageFile = ref(null);
const imagePreview = ref(null);

// Dropdown sources
const categories = ref([]);
const brands = ref([]);

// UI state
const loading = ref(false);
const success = ref(null);
const errorMessage = ref(null);
const fieldErrors = ref({});

/**
 * Loads category and brand lists from the backend in parallel.
 */
async function loadDropdowns() {
  try {
    const [catRes, brandRes] = await Promise.all([
      apiHandler.get('/api/instrument-categories'),
      apiHandler.get('/api/instrument-brands'),
    ]);
    categories.value = catRes.data;
    brands.value = brandRes.data;
  } catch {
    errorMessage.value = "Nem sikerült betölteni a kategóriákat vagy márkákat.";
  }
}

/**
 * Handles the file input change and creates a local preview URL.
 */
function onFileChange(event) {
  const file = event.target.files?.[0];
  imageFile.value = file ?? null;

  if (imagePreview.value) {
    URL.revokeObjectURL(imagePreview.value);
    imagePreview.value = null;
  }

  if (file) {
    imagePreview.value = URL.createObjectURL(file);
  }
}

/**
 * Clears the currently selected image and its preview URL.
 */
function removeImage() {
  if (imagePreview.value) {
    URL.revokeObjectURL(imagePreview.value);
  }
  imagePreview.value = null;
  imageFile.value = null;
}

/**
 * Resets every form field to its initial state.
 */
function resetForm() {
  categoryId.value = '';
  brandId.value = '';
  condition.value = 'Új';
  title.value = '';
  description.value = '';
  monthlyPrice.value = 0;
  deposit.value = 0;
  removeImage();
  fieldErrors.value = {};
}

/**
 * Submits the form. When an image is attached, uses FormData for multipart upload;
 * otherwise sends JSON for simplicity.
 *
 * Note: FormData serializes all values as strings. Laravel's integer validator
 * accepts numeric strings, but we force explicit String() conversion to avoid
 * edge cases where `v-model.number` produces an empty string after retyping.
 */
async function submit() {
  loading.value = true;
  success.value = null;
  errorMessage.value = null;
  fieldErrors.value = {};

  const monthlyPriceNum = Number(monthlyPrice.value) || 0;
  const depositNum = Number(deposit.value) || 0;

  try {
    let response;

    if (imageFile.value) {
      // Multipart upload path
      const formData = new FormData();
      formData.append('category_id', String(categoryId.value));
      formData.append('brand_id', String(brandId.value));
      formData.append('condition', String(condition.value));
      formData.append('title', String(title.value));
      formData.append('description', String(description.value || ''));
      formData.append('monthly_price', String(monthlyPriceNum));
      formData.append('deposit', String(depositNum));
      formData.append('image', imageFile.value);

      response = await apiHandler.post('/api/instruments', formData);
    } else {
      // JSON path (no image attached)
      response = await apiHandler.post('/api/instruments', {
        category_id: categoryId.value,
        brand_id: brandId.value,
        condition: condition.value,
        title: title.value,
        description: description.value || '',
        monthly_price: monthlyPriceNum,
        deposit: depositNum,
      });
    }

    success.value = `A hangszer sikeresen felvitt: "${response.data.title}"`;
    resetForm();
  } catch (err) {
    if (err.response?.status === 422) {
      fieldErrors.value = err.response.data.errors || {};
      errorMessage.value = "Kérjük javítsa az alábbi mezőket.";
    } else {
      errorMessage.value = "Hiba történt a hangszer felvitele során.";
    }
  } finally {
    loading.value = false;
  }
}

onMounted(() => {
  loadDropdowns();
});
</script>

<template>
  <div class="admin-page">

    <h1 class="mb-4">Hangszer felvitel</h1>

    <div v-if="success" class="alert alert-success">{{ success }}</div>
    <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>

    <form @submit.prevent="submit" class="card p-4">

      <div class="row g-3">

        <!-- Category -->
        <div class="col-md-6">
          <label for="category" class="form-label">Kategória</label>
          <select
              id="category"
              v-model="categoryId"
              class="form-select"
              :class="{ 'is-invalid': fieldErrors.category_id }"
              required
          >
            <option value="" disabled>-- válassz --</option>
            <option v-for="cat in categories" :key="cat.id" :value="cat.id">
              {{ cat.category_name }}
            </option>
          </select>
          <div v-if="fieldErrors.category_id" class="invalid-feedback">
            {{ fieldErrors.category_id[0] }}
          </div>
        </div>

        <!-- Brand -->
        <div class="col-md-6">
          <label for="brand" class="form-label">Márka</label>
          <select
              id="brand"
              v-model="brandId"
              class="form-select"
              :class="{ 'is-invalid': fieldErrors.brand_id }"
              required
          >
            <option value="" disabled>-- válassz --</option>
            <option v-for="brand in brands" :key="brand.id" :value="brand.id">
              {{ brand.brand_name }}
            </option>
          </select>
          <div v-if="fieldErrors.brand_id" class="invalid-feedback">
            {{ fieldErrors.brand_id[0] }}
          </div>
        </div>

        <!-- Condition -->
        <div class="col-md-6">
          <label for="condition" class="form-label">Állapot</label>
          <select
              id="condition"
              v-model="condition"
              class="form-select"
              :class="{ 'is-invalid': fieldErrors.condition }"
              required
          >
            <option value="Új">Új</option>
            <option value="Újszerű">Újszerű</option>
            <option value="Használt">Használt</option>
          </select>
          <div v-if="fieldErrors.condition" class="invalid-feedback">
            {{ fieldErrors.condition[0] }}
          </div>
        </div>

        <!-- Title -->
        <div class="col-md-6">
          <label for="title" class="form-label">Cím / megnevezés</label>
          <input
              id="title"
              v-model="title"
              type="text"
              maxlength="100"
              class="form-control"
              :class="{ 'is-invalid': fieldErrors.title }"
              required
          />
          <div v-if="fieldErrors.title" class="invalid-feedback">
            {{ fieldErrors.title[0] }}
          </div>
        </div>

        <!-- Monthly price -->
        <div class="col-md-6">
          <label for="monthly_price" class="form-label">Havi díj (Ft)</label>
          <input
              id="monthly_price"
              v-model.number="monthlyPrice"
              type="number"
              min="1"
              class="form-control"
              :class="{ 'is-invalid': fieldErrors.monthly_price }"
              required
          />
          <div v-if="fieldErrors.monthly_price" class="invalid-feedback">
            {{ fieldErrors.monthly_price[0] }}
          </div>
        </div>

        <!-- Deposit -->
        <div class="col-md-6">
          <label for="deposit" class="form-label">Kaució (Ft)</label>
          <input
              id="deposit"
              v-model.number="deposit"
              type="number"
              min="1"
              class="form-control"
              :class="{ 'is-invalid': fieldErrors.deposit }"
              required
          />
          <div v-if="fieldErrors.deposit" class="invalid-feedback">
            {{ fieldErrors.deposit[0] }}
          </div>
        </div>

        <!-- Description -->
        <div class="col-12">
          <label for="description" class="form-label">Leírás</label>
          <textarea
              id="description"
              v-model="description"
              rows="3"
              class="form-control"
              :class="{ 'is-invalid': fieldErrors.description }"
          ></textarea>
          <div v-if="fieldErrors.description" class="invalid-feedback">
            {{ fieldErrors.description[0] }}
          </div>
        </div>

        <!-- Image -->
        <div class="col-12">
          <label for="image" class="form-label">Kép (opcionális)</label>
          <input
              id="image"
              type="file"
              accept="image/jpeg,image/png,image/webp"
              class="form-control"
              :class="{ 'is-invalid': fieldErrors.image }"
              @change="onFileChange"
          />
          <div v-if="fieldErrors.image" class="invalid-feedback">
            {{ fieldErrors.image[0] }}
          </div>

          <!-- Preview — constrained size so it doesn't push the submit button below the fold -->
          <div v-if="imagePreview" class="preview-wrapper mt-3">
            <img :src="imagePreview" alt="Preview" class="preview-img" />
            <button type="button" class="btn btn-sm btn-outline-danger ms-3" @click="removeImage">
              Kép eltávolítása
            </button>
          </div>
        </div>

      </div>

      <hr class="my-4" />

      <!-- Form action buttons — always visible on their own row -->
      <div class="form-actions d-flex gap-2 flex-wrap">
        <button type="submit" class="btn btn-primary" :disabled="loading">
          {{ loading ? 'Feltöltés...' : 'Hangszer felvitele' }}
        </button>
        <button type="button" class="btn btn-outline-secondary" @click="resetForm" :disabled="loading">
          Űrlap törlése
        </button>
      </div>

    </form>

  </div>
</template>

<style scoped>
.admin-page {
  padding: 20px;
}

.preview-wrapper {
  display: flex;
  align-items: flex-start;
  gap: 1rem;
  flex-wrap: wrap;
}

.preview-img {
  max-height: 180px;
  max-width: 280px;
  border-radius: 8px;
  object-fit: cover;
  display: block;
}

.form-actions {
  margin-top: 0.5rem;
}
</style>
