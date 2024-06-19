<template>
  <v-container class="login-container">
    <v-form @submit.prevent="login" class="login-form">

      <v-card class="mx-auto" max-width="344" hover>
        <v-card-item>
          <v-card-title>
            Autheticate
          </v-card-title>

          <v-card-subtitle>
            <!-- Card subtitle secondary text -->
          </v-card-subtitle>
        </v-card-item>

        <v-card-text class="center">
          <!-- Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. -->

          <v-text-field v-model="email" label="Email" type="email" required></v-text-field>

          <v-text-field v-model="password" label="Password" type="password" required></v-text-field>

          <v-row>
            <v-col sm="12" md="6">
              <v-btn type="submit" color="green" block>Login</v-btn>
            </v-col>
            <v-col sm="12" md="6">
              <v-btn color="info" block @click="$router.push('/register')">Register</v-btn>
            </v-col>
          </v-row>

        </v-card-text>
      </v-card>
    </v-form>
  </v-container>
</template>


<script lang="ts">
import { defineComponent, ref } from 'vue'
import { useRouter } from 'vue-router'

export default defineComponent({
  setup() {
    const email = ref('')
    const password = ref('')
    const router = useRouter()

    const login = () => {
      // Aquí iría la lógica de autenticación
      // Si el login es exitoso, redirigir a la página de tareas
      localStorage.setItem('authenticate', "true");
      router.push('/tasks')
    }

    return { email, password, login }
  }
})
</script>



<style scoped>
.login-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  /* background-color: white; */
}

.login-form {
  width: 400px;
  /* height: 500px; */
  /* 
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); */
  /* background-color: #fff; */
}
</style>