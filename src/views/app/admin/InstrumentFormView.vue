<!--
  @file InstrumentFormView.vue
  @description Admin page — form for creating a new instrument.

  Loads category and brand lists on mount to populate the two <select> dropdowns.
  The form collects: category, brand, condition, title, description,
  monthly price, deposit, and an optional image file.

  Submission logic:
    - If an image file is selected → sends a multipart/form-data POST via
      apiHandler.post() which detects the FormData instance and sets the
      correct Content-Type header automatically.
    - If no image → sends a plain JSON POST for simplicity.

  Why FormData values are stringified:
    FormData serialises all values as strings. Laravel's integer validator
    accepts numeric strings, but `v-model.number` can produce an empty string
    when the user clears a number field and re-types, so Number() conversion
    is applied first to normalise the value before String() serialisation.

  On success: shows a success alert and resets the form.
  On 422:     shows field-level errors below each input.
  On other:   shows a generic error alert.
-->
<script>
import apiHandler from "@/utils/apiHandler";

export default {
  name: "InstrumentFormView",

  data() {
    return {
      // ── Form fields ──────────────────────────────────────────────────────
      categoryId: '',
      brandId: '',
      condition: 'Új',          // Default: new condition
      title: '',
      description: '',
      monthlyPrice: 0,
      deposit: 0,
      imageFile: null,          // File object from the file input
      imagePreview: null,       // Blob URL for the inline image preview

      // ── Dropdown data ────────────────────────────────────────────────────
      categories: [],           // [{id, category_name}, …]
      brands: [],               // [{id, brand_name}, …]

      // ── UI state ─────────────────────────────────────────────────────────
      loading: false,
      success: null,            // Success message string
      errorMessage: null,       // Generic error string
      fieldErrors: {}           // Laravel validation errors { field: string[] }
    };
  },

  methods: {
    /**
     * Fetches category and brand dropdown data in parallel.
     * Promise.all is used so both requests fire simultaneously.
     * On failure, shows a generic error — the form cannot function without these lists.
     */
    async loadDropdowns() {
      try {
        const [catRes, brandRes] = await Promise.all([
          apiHandler.get('/api/instrument-categories'),
          apiHandler.get('/api/instrument-brands'),
        ]);
        this.categories = catRes.data;
        this.brands = brandRes.data;
      } catch {
        this.errorMessage = "Nem sikerült betölteni a kategóriákat vagy márkákat.";
      }
    },

    /**
     * Handles the file input change event.
     * Revokes the previous object URL to avoid memory leaks, then creates a new
     * blob URL for the selected file so it can be displayed in the preview <img>.
     *
     * @param {Event} event  The native file input change event.
     */
    onFileChange(event) {
      const file = event.target.files?.[0];
      this.imageFile = file ?? null;

      /** Revoke the previous URL to free browser memory. */
      if (this.imagePreview) {
        URL.revokeObjectURL(this.imagePreview);
        this.imagePreview = null;
      }

      if (file) {
        this.imagePreview = URL.createObjectURL(file);
      }
    },

    /**
     * Clears the selected image and revokes its preview URL.
     * Called by the "Kép eltávolítása" button.
     */
    removeImage() {
      if (this.imagePreview) {
        URL.revokeObjectURL(this.imagePreview);
      }
      this.imagePreview = null;
      this.imageFile = null;
    },

    /**
     * Resets all form fields to their initial/empty state.
     * Called after a successful submission or by the "Űrlap törlése" button.
     */
    resetForm() {
      this.categoryId = '';
      this.brandId = '';
      this.condition = 'Új';
      this.title = '';
      this.description = '';
      this.monthlyPrice = 0;
      this.deposit = 0;
      this.removeImage();
      this.fieldErrors = {};
    },

    /**
     * Submits the instrument creation form.
     *
     * Two paths:
     *  1. Image selected → builds a FormData and posts as multipart/form-data.
     *     All values are explicitly converted with String() because FormData
     *     stringifies everything and v-model.number can yield '' on empty inputs.
     *  2. No image → posts a plain JSON object.
     *
     * On success (HTTP 201): shows the success message, resets the form.
     * On 422: populates fieldErrors for inline display and sets errorMessage.
     * On other errors: sets the generic errorMessage.
     */
    async submit() {
      this.loading = true;
      this.success = null;
      this.errorMessage = null;
      this.fieldErrors = {};

      /** Normalise numeric values — Number() converts '' to 0 safely. */
      const monthlyPriceNum = Number(this.monthlyPrice) || 0;
      const depositNum = Number(this.deposit) || 0;

      try {
        let response;

        if (this.imageFile) {
          /** Multipart path: build FormData and stringify every value explicitly. */
          const formData = new FormData();
          formData.append('category_id', String(this.categoryId));
          formData.append('brand_id', String(this.brandId));
          formData.append('condition', String(this.condition));
          formData.append('title', String(this.title));
          formData.append('description', String(this.description || ''));
          formData.append('monthly_price', String(monthlyPriceNum));
          formData.append('deposit', String(depositNum));
          formData.append('image', this.imageFile);  // Binary file object

          response = await apiHandler.post('/api/instruments', formData);
        } else {
          /** JSON path: no image attached, send a plain object. */
          response = await apiHandler.post('/api/instruments', {
            category_id: this.categoryId,
            brand_id: this.brandId,
            condition: this.condition,
            title: this.title,
            description: this.description || '',
            monthly_price: monthlyPriceNum,
            deposit: depositNum,
          });
        }

        this.success = `A hangszer sikeresen felvitt: "${response.data.title}"`;
        this.resetForm();

      } catch (err) {
        if (err.response?.status === 422) {
          /** Laravel validation failed — show per-field messages. */
          this.fieldErrors = err.response.data.errors || {};
          this.errorMessage = "Kérjük javítsa az alábbi mezőket.";
        } else {
          this.errorMessage = "Hiba történt a hangszer felvitele során.";
        }
      } finally {
        this.loading = false;
      }
    }
  },

  mounted() {
    this.loadDropdowns();
  }
};
</script>

<template>
  <div class="admin-page">

    <h1 class="mb-4">Hangszer felvitel</h1>

    <!-- Success alert — shown after a successful creation -->
    <div v-if="success" class="alert alert-success">{{ success }}</div>
    <!-- Generic error alert — shown for non-422 errors or summary of 422 -->
    <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>

    <!-- @submit.prevent stops native browser form submission -->
    <form @submit.prevent="submit" class="card p-4">
      <div class="row g-3">

        <!-- Category select -->
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
          <!-- Inline validation error from Laravel -->
          <div v-if="fieldErrors.category_id" class="invalid-feedback">
            {{ fieldErrors.category_id[0] }}
          </div>
        </div>

        <!-- Brand select -->
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

        <!-- Condition select — three fixed options matching the backend enum -->
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

        <!-- Title text input — maxlength mirrors the backend's string:100 rule -->
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

        <!-- Monthly price — v-model.number keeps the value as a JS number -->
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

        <!-- Deposit amount -->
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

        <!-- Description textarea — optional -->
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

        <!-- Image file input — optional; accepted types mirror the backend rules -->
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

          <!--
            Image preview — shown after a file is selected.
            Max dimensions are capped in CSS so it does not push the
            submit button below the fold on smaller screens.
          -->
          <div v-if="imagePreview" class="preview-wrapper mt-3">
            <img :src="imagePreview" alt="Preview" class="preview-img" />
            <button type="button" class="btn btn-sm btn-outline-danger ms-3" @click="removeImage">
              Kép eltávolítása
            </button>
          </div>
        </div>

      </div>

      <hr class="my-4" />

      <!-- Form action buttons -->
      <div class="form-actions d-flex gap-2 flex-wrap">
        <!-- Submit: disabled while uploading -->
        <button type="submit" class="btn btn-primary" :disabled="loading">
          {{ loading ? 'Feltöltés...' : 'Hangszer felvitele' }}
        </button>
        <!-- Reset: clears all fields without submitting -->
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

/** Preview image wrapper: flex row so the image and remove button sit side by side. */
.preview-wrapper {
  display: flex;
  align-items: flex-start;
  gap: 1rem;
  flex-wrap: wrap;
}

/** Cap preview size so it does not push page content below the fold. */
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
