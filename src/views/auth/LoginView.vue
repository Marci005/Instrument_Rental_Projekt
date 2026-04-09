<script>
import axios from 'axios'
import api from "@/utils/http.js"

export default {
  name: "LoginView",
  data() {
    return {
      form: { email: '', password: '' },
      error: null,
      loading: false
    }
  },
  methods: {
    async login() {
      this.error = null
      this.loading = true
      try {
        await axios.get('http://localhost:8000/sanctum/csrf-cookie', { withCredentials: true })

        const response = await api.post('/login', this.form)

        localStorage.setItem('role', response.data.user.role)

        this.$router.push({ name: 'home' })
      } catch (e) {
        this.error = 'Hibás email vagy jelszó.'
        console.error(e)
      } finally {
        this.loading = false
      }
    }
  }
}
</script>
