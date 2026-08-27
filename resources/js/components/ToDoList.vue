<script setup>
    import { storeToRefs } from 'pinia'
    import { ref, watch } from "vue";
    import TodoListIem from "./TodoListItem.vue";
    import { toDoStore } from "@/store/ToDoStore";
    import Loader from "./Loader.vue"
    
    
    const hideCompleted = ref(false);
    const store = toDoStore();
    const { tasks, countActive, countCompleted, isReady, errorMessage } = storeToRefs(store);
    const nbrItems = ref(0);
    
    const fetchTodos = async() => {
        store.isReady = false;
        
        try {
            const data = fetch("http://127.0.0.1:8000/api/tasks")
            .then(data => data.json())
            .then(data => {
                store.tasks = data;
                store.isReady = true;
                nbrItems.value = data.length;
            })
        } catch (e) {
            store.errorMessage = e.message;
        } finally {
            store.isReady = true;
        }
    }
    fetchTodos();

    const filterActiveTasks = () => {
        const activeTasks = store.tasks.filter(item => {
            return item.is_completed === false;
        });
        
        return store.tasks = activeTasks;
    }

</script>

<template>
    <span v-if="!store.isReady">
        <Loader />
    </span>
    <span v-else>
        <span v-if="store.tasks.length === 0">Vous n'avez pas de taches pour l'instant.</span>
        <div v-else v-for="item in store.tasks" :key="item.id">
            <TodoListIem 
            :id="item.id"
            :title="item.title"
            :is_completed="item.is_completed"
        />
        </div>
    </span>
</template>

<style scoped>
    
</style>