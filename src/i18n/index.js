import { ref, reactive, computed } from 'vue'
import cs from './cs.js'
import en from './en.js'

const messages = { cs, en }
const locale = ref('cs')

export function useI18n() {
  const t = computed(() => messages[locale.value])

  function setLocale(lang) {
    if (messages[lang]) {
      locale.value = lang
      document.documentElement.lang = lang
    }
  }

  function toggleLocale() {
    setLocale(locale.value === 'cs' ? 'en' : 'cs')
  }

  return {
    locale,
    t,
    setLocale,
    toggleLocale
  }
}
