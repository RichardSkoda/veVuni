<script setup>
import { ref, computed } from 'vue'

const password = ref('')
const authenticated = ref(false)
const authError = ref('')

const car = ref('')
const service = ref('')
const quote = ref('')
const author = ref('')
const files = ref([])
const previews = ref([])
const submitting = ref(false)
const submitResult = ref(null)

// Existing references loaded from API
const existingRefs = ref([])
const loadingRefs = ref(false)
const deletingId = ref(null)

function login() {
  authError.value = ''
  // Verify password against PHP backend
  fetch('/api/references.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-Admin-Token': password.value
    },
    body: JSON.stringify({})
  }).then(r => {
    if (r.status === 401) {
      authError.value = 'Neplatné heslo.'
    } else {
      // Password works (even if the request fails for other reasons like missing fields)
      authenticated.value = true
      loadExistingRefs()
    }
  }).catch(() => {
    authError.value = 'Chyba připojení k serveru.'
  })
}

function loadExistingRefs() {
  loadingRefs.value = true
  fetch('/api/references.php')
    .then(r => r.json())
    .then(data => {
      existingRefs.value = Array.isArray(data) ? data : []
    })
    .catch(() => {})
    .finally(() => { loadingRefs.value = false })
}

function onFileChange(e) {
  const selected = Array.from(e.target.files || [])
  files.value = selected

  // Generate previews
  previews.value = []
  selected.forEach(file => {
    const reader = new FileReader()
    reader.onload = (ev) => {
      previews.value.push({ name: file.name, url: ev.target.result })
    }
    reader.readAsDataURL(file)
  })
}

function removePreview(index) {
  previews.value.splice(index, 1)
  // Rebuild files array from remaining previews
  const dt = new DataTransfer()
  const currentFiles = Array.from(files.value)
  currentFiles.splice(index, 1)
  currentFiles.forEach(f => dt.items.add(f))
  files.value = Array.from(dt.files)
}

const canSubmit = computed(() => car.value.trim() && service.value.trim())

async function submit() {
  if (!canSubmit.value || submitting.value) return

  submitting.value = true
  submitResult.value = null

  const formData = new FormData()
  formData.append('car', car.value.trim())
  formData.append('service', service.value.trim())
  formData.append('quote', quote.value.trim())
  formData.append('author', author.value.trim())

  files.value.forEach(file => {
    formData.append('images[]', file)
  })

  try {
    const res = await fetch('/api/references.php', {
      method: 'POST',
      headers: { 'X-Admin-Token': password.value },
      body: formData
    })
    const data = await res.json()

    if (res.ok && data.success) {
      submitResult.value = { type: 'success', message: 'Reference úspěšně přidána!' }
      // Reset form
      car.value = ''
      service.value = ''
      quote.value = ''
      author.value = ''
      files.value = []
      previews.value = []
      // Reload list
      loadExistingRefs()
    } else {
      submitResult.value = { type: 'error', message: data.error || 'Nepodařilo se uložit.' }
    }
  } catch {
    submitResult.value = { type: 'error', message: 'Chyba připojení k serveru.' }
  } finally {
    submitting.value = false
  }
}

async function deleteRef(id) {
  if (!confirm('Opravdu smazat tuto referenci?')) return
  deletingId.value = id
  try {
    const res = await fetch('/api/references.php?delete=1', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-Admin-Token': password.value
      },
      body: JSON.stringify({ id })
    })
    if (res.ok) {
      loadExistingRefs()
    }
  } catch {
    // silently fail
  } finally {
    deletingId.value = null
  }
}
</script>

<template>
  <div class="admin-wrapper">
    <!-- Login gate -->
    <div v-if="!authenticated" class="admin-login">
      <div class="admin-login-card">
        <div class="admin-logo">
          <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
            <path d="M7 11V7a5 5 0 0110 0v4"/>
          </svg>
        </div>
        <h1>Administrace</h1>
        <p>Zadejte heslo pro přístup</p>
        <form @submit.prevent="login">
          <input
            v-model="password"
            type="password"
            placeholder="Heslo"
            class="admin-input"
            autocomplete="current-password"
          />
          <p v-if="authError" class="admin-error">{{ authError }}</p>
          <button type="submit" class="btn btn-primary btn-full">Přihlásit</button>
        </form>
      </div>
    </div>

    <!-- Admin panel -->
    <div v-else class="admin-panel">
      <div class="container">
        <div class="admin-header">
          <h1>Správa referencí</h1>
          <button class="btn btn-outline-sm" @click="authenticated = false; password = ''">Odhlásit</button>
        </div>

        <!-- Add new reference form -->
        <div class="admin-form-card">
          <h2>Přidat novou referenci</h2>

          <div v-if="submitResult" class="admin-alert" :class="submitResult.type">
            {{ submitResult.message }}
          </div>

          <form @submit.prevent="submit" class="admin-form">
            <div class="form-row">
              <div class="form-group">
                <label>Název vozu *</label>
                <input v-model="car" type="text" class="admin-input" placeholder="např. Škoda Octavia RS" />
              </div>
              <div class="form-group">
                <label>Jméno zákazníka</label>
                <input v-model="author" type="text" class="admin-input" placeholder="např. Jan N." />
              </div>
            </div>

            <div class="form-group">
              <label>Provedené práce *</label>
              <input v-model="service" type="text" class="admin-input" placeholder="např. Kompletní exteriér a interiér" />
            </div>

            <div class="form-group">
              <label>Recenze zákazníka</label>
              <textarea v-model="quote" class="admin-input admin-textarea" rows="3" placeholder="Volitelná citace od zákazníka..."></textarea>
            </div>

            <div class="form-group">
              <label>Fotky (max 20)</label>
              <div class="file-upload-area" @click="$refs.fileInput.click()" @dragover.prevent @drop.prevent="onFileChange({ target: { files: $event.dataTransfer.files } })">
                <input ref="fileInput" type="file" multiple accept="image/jpeg,image/png,image/webp" @change="onFileChange" class="file-input-hidden" />
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                  <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/>
                  <polyline points="17 8 12 3 7 8"/>
                  <line x1="12" y1="3" x2="12" y2="15"/>
                </svg>
                <span v-if="!files.length">Klikněte nebo přetáhněte fotky</span>
                <span v-else>{{ files.length }} {{ files.length === 1 ? 'soubor' : files.length < 5 ? 'soubory' : 'souborů' }} vybráno</span>
              </div>

              <!-- Previews -->
              <div v-if="previews.length" class="photo-previews">
                <div v-for="(p, i) in previews" :key="i" class="photo-preview">
                  <img :src="p.url" :alt="p.name" />
                  <button type="button" class="preview-remove" @click="removePreview(i)">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
                  </button>
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary" :disabled="!canSubmit || submitting">
              {{ submitting ? 'Ukládám...' : 'Přidat referenci' }}
            </button>
          </form>
        </div>

        <!-- Existing dynamic references -->
        <div class="admin-list-card">
          <h2>Přidané reference ({{ existingRefs.length }})</h2>
          <p v-if="loadingRefs" class="admin-loading">Načítám...</p>
          <p v-else-if="!existingRefs.length" class="admin-empty">Zatím žádné přidané reference.</p>

          <div v-else class="admin-ref-list">
            <div v-for="r in existingRefs" :key="r.id" class="admin-ref-item">
              <div class="admin-ref-thumbs" v-if="r.images && r.images.length">
                <img v-for="(img, j) in r.images.slice(0, 3)" :key="j" :src="img" :alt="r.car" />
                <span v-if="r.images.length > 3" class="admin-ref-more">+{{ r.images.length - 3 }}</span>
              </div>
              <div class="admin-ref-info">
                <strong>{{ r.car }}</strong>
                <span class="admin-ref-service">{{ r.service }}</span>
                <span v-if="r.quote" class="admin-ref-quote">„{{ r.quote }}"</span>
                <small v-if="r.author">— {{ r.author }}</small>
              </div>
              <button class="btn-delete" @click="deleteRef(r.id)" :disabled="deletingId === r.id">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <polyline points="3 6 5 6 21 6"/>
                  <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/>
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.admin-wrapper {
  min-height: 100vh;
  background: var(--color-bg-light);
}

/* Login */
.admin-login {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--color-primary);
}

.admin-login-card {
  background: var(--color-primary-light);
  padding: 3rem;
  border-radius: var(--radius-lg);
  width: 100%;
  max-width: 380px;
  text-align: center;
  box-shadow: var(--shadow-xl);
}

.admin-logo {
  color: var(--color-accent);
  margin-bottom: 1.5rem;
}

.admin-login-card h1 {
  font-family: var(--font-heading);
  color: white;
  font-size: 1.8rem;
  margin-bottom: 0.5rem;
}

.admin-login-card p {
  color: rgba(255,255,255,0.5);
  font-size: 0.9rem;
  margin-bottom: 2rem;
}

.admin-error {
  color: var(--color-error);
  font-size: 0.85rem;
  margin: -0.5rem 0 1rem;
}

/* Panel */
.admin-panel {
  padding-top: 2rem;
  padding-bottom: 4rem;
}

.admin-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 2rem;
  padding-bottom: 1rem;
  border-bottom: 1px solid var(--color-border);
}

.admin-header h1 {
  font-family: var(--font-heading);
  font-size: 1.8rem;
  color: var(--color-primary);
}

.btn-outline-sm {
  padding: 0.5rem 1.25rem;
  background: transparent;
  color: var(--color-text-light);
  border: 1px solid var(--color-border);
  border-radius: 50px;
  font-size: 0.8rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s;
}

.btn-outline-sm:hover {
  border-color: var(--color-error);
  color: var(--color-error);
}

/* Form card */
.admin-form-card,
.admin-list-card {
  background: white;
  border-radius: var(--radius-lg);
  padding: 2rem;
  box-shadow: var(--shadow-sm);
  margin-bottom: 2rem;
}

.admin-form-card h2,
.admin-list-card h2 {
  font-family: var(--font-heading);
  font-size: 1.3rem;
  color: var(--color-primary);
  margin-bottom: 1.5rem;
  padding-bottom: 0.75rem;
  border-bottom: 1px solid var(--color-border);
}

.admin-form {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}

.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.25rem;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 0.4rem;
}

.form-group label {
  font-size: 0.8rem;
  font-weight: 600;
  color: var(--color-text-light);
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.admin-input {
  padding: 0.75rem 1rem;
  border: 1px solid var(--color-border);
  border-radius: var(--radius-md);
  font-family: var(--font-body);
  font-size: 0.95rem;
  color: var(--color-text);
  background: var(--color-bg-light);
  transition: border-color 0.2s;
  width: 100%;
}

.admin-login-card .admin-input {
  background: rgba(255,255,255,0.08);
  border-color: rgba(255,255,255,0.15);
  color: white;
  margin-bottom: 1rem;
}

.admin-login-card .admin-input::placeholder {
  color: rgba(255,255,255,0.35);
}

.admin-input:focus {
  outline: none;
  border-color: var(--color-accent);
}

.admin-textarea {
  resize: vertical;
  min-height: 80px;
}

/* File upload */
.file-upload-area {
  border: 2px dashed var(--color-border);
  border-radius: var(--radius-md);
  padding: 2rem;
  text-align: center;
  cursor: pointer;
  color: var(--color-text-light);
  transition: border-color 0.2s, background 0.2s;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.5rem;
}

.file-upload-area:hover {
  border-color: var(--color-accent);
  background: rgba(201, 168, 76, 0.04);
}

.file-input-hidden {
  display: none;
}

.photo-previews {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  margin-top: 0.75rem;
}

.photo-preview {
  position: relative;
  width: 80px;
  height: 80px;
  border-radius: var(--radius-sm);
  overflow: hidden;
}

.photo-preview img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.preview-remove {
  position: absolute;
  top: 2px;
  right: 2px;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: rgba(0,0,0,0.7);
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  border: none;
  padding: 0;
}

/* Buttons */
.btn {
  display: inline-block;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
  border-radius: 50px;
  cursor: pointer;
  transition: all 0.2s;
  border: none;
  font-family: var(--font-body);
}

.btn-primary {
  background: var(--color-accent);
  color: white;
  padding: 0.85rem 2rem;
  font-size: 0.9rem;
}

.btn-primary:hover:not(:disabled) {
  background: var(--color-accent-light);
  transform: translateY(-1px);
  box-shadow: 0 4px 16px rgba(201, 168, 76, 0.3);
}

.btn-primary:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.btn-full {
  width: 100%;
}

/* Alert */
.admin-alert {
  padding: 0.75rem 1rem;
  border-radius: var(--radius-md);
  font-size: 0.9rem;
  font-weight: 500;
}

.admin-alert.success {
  background: rgba(40, 167, 69, 0.1);
  color: var(--color-success);
  border: 1px solid rgba(40, 167, 69, 0.2);
}

.admin-alert.error {
  background: rgba(220, 53, 69, 0.1);
  color: var(--color-error);
  border: 1px solid rgba(220, 53, 69, 0.2);
}

/* Existing refs list */
.admin-loading,
.admin-empty {
  color: var(--color-text-light);
  font-size: 0.9rem;
  text-align: center;
  padding: 2rem;
}

.admin-ref-list {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.admin-ref-item {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 1rem;
  background: var(--color-bg-light);
  border-radius: var(--radius-md);
  transition: box-shadow 0.2s;
}

.admin-ref-item:hover {
  box-shadow: var(--shadow-sm);
}

.admin-ref-thumbs {
  display: flex;
  gap: 3px;
  flex-shrink: 0;
}

.admin-ref-thumbs img {
  width: 48px;
  height: 48px;
  object-fit: cover;
  border-radius: var(--radius-sm);
}

.admin-ref-more {
  width: 48px;
  height: 48px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--color-primary);
  color: var(--color-accent);
  border-radius: var(--radius-sm);
  font-size: 0.75rem;
  font-weight: 700;
}

.admin-ref-info {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 0.2rem;
  min-width: 0;
}

.admin-ref-info strong {
  color: var(--color-primary);
  font-size: 0.95rem;
}

.admin-ref-service {
  font-size: 0.8rem;
  color: var(--color-text-light);
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.admin-ref-quote {
  font-size: 0.8rem;
  color: var(--color-text);
  font-style: italic;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.admin-ref-info small {
  font-size: 0.75rem;
  color: var(--color-accent);
  font-weight: 600;
}

.btn-delete {
  flex-shrink: 0;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: transparent;
  color: var(--color-text-light);
  border: 1px solid var(--color-border);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.2s;
}

.btn-delete:hover {
  background: rgba(220, 53, 69, 0.1);
  border-color: var(--color-error);
  color: var(--color-error);
}

@media (max-width: 600px) {
  .form-row {
    grid-template-columns: 1fr;
  }

  .admin-form-card,
  .admin-list-card {
    padding: 1.25rem;
  }

  .admin-ref-item {
    flex-wrap: wrap;
  }
}
</style>
