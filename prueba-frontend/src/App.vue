<template>
  <div class="page-content page-container" id="page-content">
    <div class="padding">
      <div class="row container d-flex justify-content-center">
        <div class="col-md-12">
          <div class="card px-3">
            <div class="card-body">
              <h4 class="card-title">Awesome Todo list</h4>
              <div class="add-items d-flex">
                <input v-model="newTask" type="text" class="form-control todo-list-input"
                  placeholder="What do you need to do today?">
                <h4 class="card-title"> Order: </h4>
                <select v-model="newOrder" type="number" class="form-control todo-list-input" id="order-task" required>
                  <option value="" disabled selected>Select an order of importance from 1 to 5</option>
                  <option value=1>1</option>
                  <option value=2>2</option>
                  <option value=3>3</option>
                  <option value=4>4</option>
                  <option value=5>5</option>
                </select>
                <button @click="addTask" class="add btn btn-primary font-weight-bold todo-list-add-btn">Add</button>
                <button @click="orderTask" class="add btn btn-primary font-weight-bold todo-list-add-btn">Order</button>
                <button @click="toggleFilter" class="btn btn-primary font-weight-bold todo-list-add-btn">
                  {{ filterCompleted ? 'Show All' : 'Show Completed' }}
                </button>

              </div>
              <div class="list-wrapper">
                <ul class="d-flex flex-column-reverse todo-list">
                  <li v-for="task in tasks" :key="task.id" :class="{ 'completed': task.completed }">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox" :checked="task.completed"
                          @change="updateTaskCompletion(task)">
                        {{ task.title }}
                        <i class="input-helper"></i>
                      </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline" @click="deleteTask(task)"></i>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div v-if="error" class="alert alert-danger mt-3">{{ error }}</div>
          <div v-if="successMessage" class="alert alert-success mt-3">{{ successMessage }}</div>
        </div>
      </div>
    </div>
  </div>
</template>



<script>
import axios from 'axios';

export default {
  data() {
    return {
      tasks: null,
      newTask: '',
      newOrder: null,
      filterCompleted: false,
      error: null,
      successMessage: null
    }
  },
  mounted() {
    this.getTasks();
  },
  methods: {
    async getTasks() {
      try {
        const response = await axios.get('http://prueba-funibertodo.test/api/v1/tasks');
        this.tasks = response.data;


        if (this.filterCompleted) {
          this.tasks = this.tasks.filter(task => task.completed);
        }


      } catch (error) {
        console.error('Error fetching tasks:', error);
      }
    },

    addTask() {

      if (this.newTask.trim() === '') {
        this.error = 'Please enter a task before adding it.';
        setTimeout(() => {
          this.error = null;
        }, 4000);
        return;
      }

      const newTaskObject = { title: this.newTask, order: this.newOrder, completed: false };
      axios.post('http://prueba-funibertodo.test/api/v1/tasks', newTaskObject).then(
        res => {
          this.tasks.unshift(res.data);
          this.newTask = '';
          this.newOrder = null;
          this.error = null;
          this.successMessage = 'The task was successfully recorded!';


          setTimeout(() => {
            this.successMessage = null;
          }, 4000);


          this.getTasks();
        }
      ).catch(error => {
        this.error = 'Error adding task. Please try again.';

        setTimeout(() => {
          this.error = null;
        }, 4000);
      });
    },
    updateTaskCompletion(task) {
      const newStatus = !task.completed;
      axios.put(`http://prueba-funibertodo.test/api/v1/tasks/${task.id}`, {
        title: task.title,
        order: task.order, completed: newStatus
      }).then(
        res => {
          this.error = null;
          this.successMessage = 'The task was successfully updated!';

          setTimeout(() => {
            this.successMessage = null;
          }, 4000);
          this.getTasks();
        }
      ).catch(error => {
        this.error = 'Error updating task. Please try again.';

        setTimeout(() => {
          this.error = null;
        }, 4000);
      });
    },
    deleteTask(task) {
      axios.delete(`http://prueba-funibertodo.test/api/v1/tasks/${task.id}`)
        .then(() => {
          this.error = null;
          this.successMessage = 'The task was successfully deleted!';
          setTimeout(() => {
            this.successMessage = null;
          }, 4000);
          this.getTasks();
        })
        .catch(error => {
          this.error = 'Error deleting task. Please try again.';

          setTimeout(() => {
            this.error = null;
          }, 4000);
        });
    },
    orderTask() {
      this.tasks.sort((a, b) => b.order - a.order);
      this.successMessage = 'The tasks were ordered from most to least important correctly!';
      setTimeout(() => {
        this.successMessage = null;
      }, 2000);
    },
    toggleFilter() {
      this.filterCompleted = !this.filterCompleted;
      this.getTasks();
    }
  }
}
</script>

<style src="./css/styles.css"></style>
