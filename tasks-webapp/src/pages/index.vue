<template>
  <div v-if="authenticate == undefined || authenticate == null">
    <HomeLogin />
  </div>
  <div v-else>
    <TasksAuthenticate />
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted } from 'vue'
// import { useRouter } from 'vue-router'

export default defineComponent({
  setup() {
    const authenticate = ref<string|null>(null)
    // const router = useRouter()

    onMounted(() => {
      authenticate.value = localStorage.getItem('authenticate') || null
    })

    return { authenticate, onMounted }
  }
})

</script>
