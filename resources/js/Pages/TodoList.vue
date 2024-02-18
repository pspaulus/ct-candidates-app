<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, computed, onMounted, watch } from 'vue';
import { getTasks, createTask, completeTask, deleteTask } from '../Services/TaskServices';

const filter = ref('');
const tasks = ref([]);
const taskPending = ref([]);
const newTask = ref('');
const taskFinish = ref([]);
const taskExist = ref(false);
const ascendingOrder = ref(true);
const enableTaskCreated = ref(true);
const loading = ref(true);

const taskFilter = computed(() => {
    const filteredTasks = taskPending.value.filter((task) => {
        const lowercaseTitle = task.title.toLowerCase();
        const lowercaseFilter = filter.value.toLowerCase();
        const includesFilter = lowercaseTitle.includes(lowercaseFilter);
        return includesFilter;
    });

    const sortedTasks = filteredTasks.sort((a, b) => {
        if (ascendingOrder.value) {
            return a.title.localeCompare(b.title);
        }
        return b.title.localeCompare(a.title);
    });

    return sortedTasks;
});

const toggleOrden = () => {
    ascendingOrder.value = !ascendingOrder.value;
};

const taskDelete = async (id) => {
    await deleteTask(id);
    taskSave();
};

const taksComplete = async (id) => {
    const response = await completeTask(id);
    if(response) {
        taskSave();
    }
}

const created = async () => {
    if(newTask.value != '') {
        const response = await createTask(newTask.value);
        if(response){
            newTask.value = '';
            taskSave();
        }
    }
}

const taskSave = async () => {
    tasks.value = await getTasks();
    taskPending.value = tasks.value.filter(task => !task.fulfilled);
    taskFinish.value = tasks.value.filter(task => task.fulfilled);
}

onMounted(async() => {
    const chargedPage = localStorage.getItem('pageReloaded');
    loading.value = true;
    if (chargedPage == 'false') {
        setTimeout(() => {
            location.reload();
            localStorage.setItem('pageReloaded', true);
        }, 3000);
    } else {
        taskSave();
        loading.value = false;
    }
});

watch(taskFinish, value => {
    if (value.length > 0) {
        taskExist.value = true;
    } else {
        taskExist.value = false;
    }
})

watch(newTask, value => {
    if (value != '') {
        enableTaskCreated.value = false;
    } else {
        enableTaskCreated.value = true;
    }
})

</script>

<template>
    <Head title="TodoList" />

    <AuthenticatedLayout>
        <div class="flex items-center justify-center h-screen" v-if="loading">
            <div class="animate-spin rounded-full h-16 w-16 border-t-2 border-blue-500 border-4"></div>
        </div>
        <div class="flex items-center justify-center h-full" v-else>
            <div class="card p-6 w-full max-w-md">
                <div class="flex mb-4 items-center justify-center">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pending tasks</h2>
                </div>
                <div class="flex mb-4">
                    <input type="text" v-model="filter" placeholder="Search task..."
                        class="flex-1 px-4 py-2 border rounded-md mr-2" />

                    <button @click="toggleOrden" class="px-4 py-2 bg-blue-600 text-white rounded-md">
                        {{ ascendingOrder ? 'Ascending order' : 'Descending order' }}
                    </button>
                </div>
                <div class="flex mb-4">
                    <input type="text" v-model="newTask" placeholder="Add task..."
                        class="flex-1 px-4 py-2 border rounded-md mr-2" />

                    <button @click="created" :disabled="enableTaskCreated"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md"
                        :class="{ 'opacity-50 cursor-not-allowed': enableTaskCreated }">
                        Create
                    </button>
                </div>

                <ul>
                    <li v-for="item in taskFilter" :key="item.id" class="mb-2">
                        <div class="flex items-center justify-between border rounded-md p-3">
                            <span>{{ item.title }}</span>
                            <div>
                                <button @click="taksComplete(item.id)"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-4 mr-2 rounded">✓</button>
                                <button @click="taskDelete(item.id)"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded">X</button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>


            <div class="card p-6 w-full max-w-md" v-if="taskExist">
                <div class="flex mb-4 items-center justify-center">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Completed tasks</h2>
                </div>

                <ul>
                    <li v-for="item in taskFinish" :key="item.id" class="mb-2">
                        <div class="flex bg-green-300 items-center justify-center border rounded-md p-3">
                            <span>{{ item.title }}</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style type="text/css"></style>
