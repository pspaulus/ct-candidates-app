<template>
  <v-container class="register-container">
    <v-form @submit.prevent="register" class="register-form">

      <v-card class="mx-auto" max-width="644" hover>
        <v-card-item>
          <v-card-title>
            Register
          </v-card-title>

          <v-card-subtitle>
            <!-- Card subtitle secondary text -->
          </v-card-subtitle>
        </v-card-item>

        <v-card-text class="center">

          <v-text-field v-model="email" label="FirstName" type="text" required></v-text-field>

          <v-text-field v-model="email" label="LastName" type="text" required></v-text-field>

          <v-text-field v-model="email" label="Email" type="email" required></v-text-field>

          <v-text-field v-model="password" label="Password" type="password" required></v-text-field>

          <v-text-field v-model="password" label="Password Repeat" type="password" required></v-text-field>

          <v-row>
            <v-col sm="12" md="6">
              <v-btn type="submit" color="green">Register</v-btn>
            </v-col>
            <v-col sm="12" md="6">
              <v-btn color="info" @click="$router.push('/')">Back to Login</v-btn>
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

    const register = () => {
      // Aquí iría la lógica de registro
      // Si el registro es exitoso, redirigir a la página de login
      router.push('/')
    }

    return { email, password, register }
  }
})
</script>


<style scoped>
.register-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  /* background-color: white; */
}

.register-form {
  width: 450px;
  padding: 20px;
}
</style>