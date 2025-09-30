<template>
    <main style="min-height: 50vh; margin-top: 2rem">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <!-- Add new Task -->
                    <NewTask @added="handleAddedTask"/>
                    <!-- List of uncompleted tasks -->
                    <Tasks :tasks="uncompletedTasks"/>
                    <!-- show toggle button -->
                    <div class="text-center my-3" v-show="showToggleCompletedBtn">
                        <button class="btn btn-sm btn-secondary"
                            @click="showCompletedTasks = !showCompletedTasks">
                            <span v-if="!showCompletedTasks">Show completed</span>
                            <span v-else>Hide completed</span>
                        </button>
                    </div>
                    <!-- List of completed tasks -->
                    <Tasks :tasks="completedTasks"
                        :show="completedTasksIsVisible && showCompletedTasks"/>

                </div>
            </div>
        </div>
    </main>
</template>


<script setup>
import { onMounted, ref, computed } from "vue";
import { allTasks, createTask } from "../http/task-api";
import Tasks from "../components/tasks/Tasks.vue";
import NewTask from "../components/tasks/NewTask.vue";
import csrfApi from "../http/csrfApi.js";


const tasks = ref([])

onMounted(async () => {
  await csrfApi.get("/sanctum/csrf-cookie");
  const { data } = await allTasks();
  tasks.value = data.data;
});

const uncompletedTasks = computed(() => tasks.value.filter(task=>!task.is_completed))
const completedTasks = computed(() => tasks.value.filter(task=>task.is_completed))
const showToggleCompletedBtn = computed(
    () => uncompletedTasks.value.length>0 && completedTasks.value.length>0
)
const completedTasksIsVisible = computed(
    () => uncompletedTasks.value.length === 0 || completedTasks.value.length > 0
)
const showCompletedTasks = ref(false)
const handleAddedTask = async (newTask) => {
  await csrfApi.get("/sanctum/csrf-cookie");  // refresh cookie CSRF trước khi gọi POST
  const { data: createdTask } = await createTask(newTask);
  tasks.value.unshift(createdTask.data);
};
</script>