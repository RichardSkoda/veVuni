<script setup>
import { ref, reactive, computed, onMounted } from 'vue'
import { useI18n } from '../i18n'

const { t } = useI18n()

const form = reactive({
  name: '',
  email: '',
  service: '',
  message: ''
})

const services = computed(() => t.value.contact.serviceOptions)

const isSubmitting = ref(false)
const submitStatus = ref(null) // 'success' | 'error' | null
const statusMessage = ref('')

const sectionRef = ref(null)
const isVisible = ref(false)

async function handleSubmit() {
  if (!form.name || !form.email || !form.service || !form.message) {
    submitStatus.value = 'error'
    statusMessage.value = t.value.contact.errorFillAll
    return
  }

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
  if (!emailRegex.test(form.email)) {
    submitStatus.value = 'error'
    statusMessage.value = t.value.contact.errorEmail
    return
  }

  isSubmitting.value = true
  submitStatus.value = null

  try {
    const response = await fetch('/api/contact.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ ...form })
    })

    if (response.ok) {
      submitStatus.value = 'success'
      statusMessage.value = t.value.contact.successMessage
      form.name = ''
      form.email = ''
      form.service = ''
      form.message = ''
    } else {
      throw new Error('Server error')
    }
  } catch (err) {
    console.error('Contact form error:', err)
    submitStatus.value = 'error'
    statusMessage.value = t.value.contact.errorSend
  } finally {
    isSubmitting.value = false
    setTimeout(() => {
      submitStatus.value = null
    }, 8000)
  }
}

onMounted(() => {
  const observer = new IntersectionObserver(
    ([entry]) => {
      if (entry.isIntersecting) {
        isVisible.value = true
        observer.disconnect()
      }
    },
    { threshold: 0.1 }
  )
  if (sectionRef.value) {
    observer.observe(sectionRef.value)
  }
})
</script>

<template>
  <section id="contact" class="section section-dark" ref="sectionRef">
    <div class="container">
      <h2 class="section-title">{{ t.contact.title }}</h2>
      <p v-if="t.contact.subtitle" class="section-subtitle">{{ t.contact.subtitle }}</p>

      <div class="contact-grid" :class="{ visible: isVisible }">
        <div class="contact-info">
          <div class="info-card">
            <div class="info-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <div>
              <h4>{{ t.contact.addressLabel }}</h4>
              <p>Slunéčkova 1982<br>Lysá nad Labem, 289 22</p>
            </div>
          </div>

          <div class="info-card">
            <div class="info-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
            </div>
            <div>
              <h4>{{ t.contact.phoneLabel }}</h4>
              <p><a href="tel:+420733656261">+420 733 656 261</a></p>
            </div>
          </div>

          <div class="info-card">
            <div class="info-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            </div>
            <div>
              <h4>{{ t.contact.emailLabel }}</h4>
              <p><a href="mailto:michal@vevuni.cz">michal@vevuni.cz</a></p>
            </div>
          </div>

          <div class="info-card">
            <div class="info-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/></svg>
            </div>
            <div>
              <h4>{{ t.contact.billingLabel }}</h4>
              <p>IČ: 86757351<br>DIČ: CZ8602112794</p>
            </div>
          </div>

          <div class="info-card">
            <div class="info-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <div>
              <h4>{{ t.contact.hoursLabel }}</h4>
              <p>{{ t.contact.hoursValue.split('\n')[0] }}<br>{{ t.contact.hoursValue.split('\n')[1] }}</p>
            </div>
          </div>
        </div>

        <form class="contact-form" @submit.prevent="handleSubmit">
          <div class="form-group">
            <label for="name">{{ t.contact.formName }}</label>
            <input
              id="name"
              v-model="form.name"
              type="text"
              :placeholder="t.contact.formNamePlaceholder"
              required
            />
          </div>

          <div class="form-group">
            <label for="email">{{ t.contact.formEmail }}</label>
            <input
              id="email"
              v-model="form.email"
              type="email"
              :placeholder="t.contact.formEmailPlaceholder"
              required
            />
          </div>

          <div class="form-group">
            <label for="service">{{ t.contact.formService }}</label>
            <select id="service" v-model="form.service" required>
              <option value="" disabled>{{ t.contact.formServicePlaceholder }}</option>
              <option v-for="s in services" :key="s" :value="s">{{ s }}</option>
            </select>
          </div>

          <div class="form-group">
            <label for="message">{{ t.contact.formMessage }}</label>
            <textarea
              id="message"
              v-model="form.message"
              rows="5"
              :placeholder="t.contact.formMessagePlaceholder"
              required
            ></textarea>
          </div>

          <Transition name="status">
            <div v-if="submitStatus" class="form-status" :class="submitStatus">
              <svg v-if="submitStatus === 'success'" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
              <svg v-else width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M15 9l-6 6M9 9l6 6"/></svg>
              {{ statusMessage }}
            </div>
          </Transition>

          <button
            type="submit"
            class="btn btn-primary btn-submit"
            :disabled="isSubmitting"
          >
            <svg v-if="!isSubmitting" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
            <span v-if="isSubmitting" class="spinner"></span>
            {{ isSubmitting ? t.contact.formSubmitting : t.contact.formSubmit }}
          </button>
        </form>
      </div>
    </div>
  </section>
</template>

<style scoped>
.contact-grid {
  display: grid;
  grid-template-columns: 1fr 1.25fr;
  gap: 3rem;
  align-items: start;
  opacity: 0;
  transform: translateY(30px);
  transition: all 0.6s ease;
}

.contact-grid.visible {
  opacity: 1;
  transform: translateY(0);
}

/* Contact Info */
.contact-info {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.info-card {
  display: flex;
  gap: 1rem;
  padding: 1.25rem;
  background: rgba(255, 255, 255, 0.05);
  border-radius: var(--radius-md);
  border: 1px solid rgba(255, 255, 255, 0.08);
  transition: all var(--transition-normal);
}

.info-card:hover {
  background: rgba(255, 255, 255, 0.08);
  border-color: rgba(201, 168, 76, 0.3);
}

.info-icon {
  flex-shrink: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 48px;
  height: 48px;
  border-radius: var(--radius-sm);
  background: rgba(201, 168, 76, 0.15);
  color: var(--color-accent);
}

.info-card h4 {
  font-family: var(--font-body);
  font-size: 0.9rem;
  font-weight: 600;
  color: var(--color-accent);
  margin-bottom: 0.25rem;
}

.info-card p {
  font-size: 0.85rem;
  color: rgba(255, 255, 255, 0.65);
  line-height: 1.5;
}

.info-card a {
  color: rgba(255, 255, 255, 0.65);
  text-decoration: underline;
  text-decoration-color: rgba(255, 255, 255, 0.2);
}

.info-card a:hover {
  color: var(--color-accent);
}

/* Form */
.contact-form {
  background: rgba(255, 255, 255, 0.05);
  border-radius: var(--radius-lg);
  padding: 2.5rem;
  border: 1px solid rgba(255, 255, 255, 0.08);
}

.form-group {
  margin-bottom: 1.25rem;
}

.form-group label {
  display: block;
  font-size: 0.85rem;
  font-weight: 500;
  color: rgba(255, 255, 255, 0.7);
  margin-bottom: 0.5rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.form-group input,
.form-group select,
.form-group textarea {
  width: 100%;
  padding: 0.875rem 1rem;
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(255, 255, 255, 0.15);
  border-radius: var(--radius-sm);
  color: white;
  font-size: 0.95rem;
  transition: all var(--transition-fast);
  outline: none;
}

.form-group input::placeholder,
.form-group textarea::placeholder {
  color: rgba(255, 255, 255, 0.3);
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
  border-color: var(--color-accent);
  background: rgba(255, 255, 255, 0.1);
  box-shadow: 0 0 0 3px rgba(201, 168, 76, 0.15);
}

.form-group select {
  appearance: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23c9a84c' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 1rem center;
  padding-right: 2.5rem;
}

.form-group select option {
  background: var(--color-primary);
  color: white;
}

.form-group textarea {
  resize: vertical;
  min-height: 120px;
}

.btn-submit {
  width: 100%;
  padding: 1rem;
  font-size: 1rem;
  margin-top: 0.5rem;
}

.btn-submit:disabled {
  opacity: 0.7;
  cursor: not-allowed;
  transform: none !important;
}

.spinner {
  display: inline-block;
  width: 18px;
  height: 18px;
  border: 2px solid transparent;
  border-top-color: var(--color-primary);
  border-radius: 50%;
  animation: spin 0.6s linear infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

.form-status {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 1rem;
  border-radius: var(--radius-sm);
  font-size: 0.9rem;
  margin-bottom: 1rem;
}

.form-status.success {
  background: rgba(40, 167, 69, 0.15);
  border: 1px solid rgba(40, 167, 69, 0.3);
  color: #6fcf97;
}

.form-status.error {
  background: rgba(220, 53, 69, 0.15);
  border: 1px solid rgba(220, 53, 69, 0.3);
  color: #ff6b6b;
}

.status-enter-active,
.status-leave-active {
  transition: all 0.3s ease;
}

.status-enter-from,
.status-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}

@media (max-width: 768px) {
  .contact-grid {
    grid-template-columns: 1fr;
  }

  .contact-form {
    padding: 1.5rem;
  }
}
</style>
