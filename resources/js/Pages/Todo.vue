<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import { Head } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
import { reactive } from "vue";

export default {
    components: {
        AuthenticatedLayout,
        PrimaryButton,
        DangerButton,
        TextInput,
        Dropdown,
        DropdownLink,
        Head,
    },
    props: {
        todos: Object,
    },
    setup() {
        const form = reactive({
            title: null,
            order: null,
        });

        function submit() {
            if (form.title) {
                router.post("/todos", form);
                form.title = null;
            }
        }

        function updateStatus(todo) {
            todo.completed = !todo.completed;
            router.put("/todos/" + todo.id, todo);
        }

        function deleteTodo(todo) {
            router.delete("/todos/" + todo.id);
        }

        return {
            form,
            submit,
            updateStatus,
            deleteTodo,
        };
    },
};
</script>

<template>
    <Head title="Todo" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Todos
            </h2>
        </template>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
            >
                <div class="p-6 text-gray-900 dark:text-gray-100 flex gap-10">
                    <TextInput
                        placeholder="Add a new todo..."
                        v-model="form.title"
                    />
                    <PrimaryButton @click="submit">Add</PrimaryButton>
                    <div class="hidden sm:flex sm:items-center">
                        <div class="absolute">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button
                                            type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"
                                        >
                                            Filter

                                            <svg
                                                class="ms-2 -me-0.5 h-4 w-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <DropdownLink
                                        :href="route('todos')"
                                        as="button"
                                    >
                                        All
                                    </DropdownLink>
                                    <DropdownLink
                                        :href="
                                            route('todos', {
                                                filter: 'completed',
                                            })
                                        "
                                        as="button"
                                    >
                                        Completed
                                    </DropdownLink>
                                    <DropdownLink
                                        :href="
                                            route('todos', {
                                                filter: 'pending',
                                            })
                                        "
                                        as="button"
                                    >
                                        Pending
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </div>
                    </div>
                </div>
                <ol>
                    <li
                        class="px-6 pb-4 text-xl"
                        v-for="(todo, index) in todos"
                        :key="todo.id"
                    >
                        <div class="flex justify-between">
                            <label
                                class="pl-4 text-gray-900 dark:text-gray-100"
                            >
                                <input
                                    type="checkbox"
                                    :checked="todo.completed"
                                    @click="updateStatus(todo)"
                                    class="mr-5 border-transparent focus:border-transparent focus:ring-0"
                                />{{ todo.title }}</label
                            >
                            <DangerButton @click="deleteTodo(todo)"
                                >Delete</DangerButton
                            >
                        </div>
                    </li>
                </ol>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
