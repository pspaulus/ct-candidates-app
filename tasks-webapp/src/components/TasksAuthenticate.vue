<template>
  <v-container>
    <v-app-bar app color="black" dark>
      <v-toolbar-title style="color: chocolate;">Tasks</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-label style="color: lightskyblue;">{{ user }}</v-label>
      <v-btn @click="logout" color="warning">Logout</v-btn>
    </v-app-bar>
    <v-main>
      <v-container class="pa-4 tasks-container">
        <v-card class="tasks-form" max-width="700px">
          <v-card-title class="headline">Awesome Todo List</v-card-title>
          <v-row>
            <v-col cols="10">
              <v-text-field v-model="newTask" label="What do you need to do today?" dense outlined></v-text-field>
            </v-col>
            <v-col cols="2">
              <v-btn @click="addTask" block color="green">Add</v-btn>
            </v-col>
          </v-row>
          <v-list>
            <v-list-item v-for="(task, index) in tasks" :key="index">
              <v-row>
                <v-col cols="2">
                  <v-list-item-action>
                    <v-checkbox v-model="task.completed" @change="toggleTask(index)"></v-checkbox>
                  </v-list-item-action>
                </v-col>
                <v-col cols="9">
                  <v-list-item-content :class="{ 'text-decoration-line-through': task.completed }">
                    <v-list-item-title>{{ task.text }}</v-list-item-title>
                  </v-list-item-content>
                </v-col>

                <v-col cols="1">
                  <v-list-item-action>
                    <v-btn density="compact" color="red" icon="mdi-close" @click="removeTask(index)"></v-btn>
                  </v-list-item-action>
                </v-col>
              </v-row>
            </v-list-item>
          </v-list>
        </v-card>
      </v-container>
    </v-main>
  </v-container>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'

interface Task {
  text: string
  completed: boolean
}

export default defineComponent({
  setup() {
    const tasks = ref<Task[]>([
      { text: 'Print bills', completed: false },
      { text: 'Call Ramppo', completed: true },
      { text: 'Print Statements all', completed: false },
      { text: 'It be advisable for me to think about business content?', completed: false },
      { text: 'For what reason would it be advisable for me to think.', completed: true },
      { text: 'For what reason would it be advisable.', completed: false }
    ])

    const newTask = ref<string>('')
    const user = ref<string>('')
    const router = useRouter()

    onMounted(() => {
      user.value = localStorage.getItem('user') || 'Ronny Matute'
    })

    const addTask = () => {
      if (newTask.value.trim() !== '') {
        tasks.value.push({ text: newTask.value, completed: false })
        newTask.value = ''
      }
    }

    const removeTask = (index: number) => {
      tasks.value.splice(index, 1)
    }

    const toggleTask = (index: number) => {
      tasks.value[index].completed = !tasks.value[index].completed
    }

    const logout = () => {
      localStorage.removeItem('user')
      localStorage.removeItem('authenticate')
      router.push('/home')
    }

    return { tasks, newTask, addTask, removeTask, toggleTask, user, logout }
  }
})
</script>

<style scoped>
.tasks-container {
  display: flex;
  justify-content: center;
  align-items: center;
}

.tasks-form {
  width: 650px;
  padding: 20px;
}
</style>
