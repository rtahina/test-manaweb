<script setup>
    import { storeToRefs } from 'pinia'
    import { ref, watch } from "vue";
    import TodoListIem from "./TodoListItem.vue";
    import { toDoStore } from "@/store/ToDoStore";
    import Loader from "./Loader.vue"
    
    const isLoading = ref(false);
    const isReady = ref(false);
    // const items = ref([]);
    const hideCompleted = ref(false);
    const store = toDoStore();
    const { tasks, countActive, countCompleted, errorMessage, isNewItem } = storeToRefs(store);
    const nbrItems = ref(0);
    
    const fetchTodos = async() => {
        isLoading.value = true;
        isReady.value = false;
        
        try {
            const data = fetch("http://127.0.0.1:8000/api/tasks")
            .then(data => data.json())
            .then(data => {
                // items.value = data;
                store.tasks = data;
                isReady.value = true;
                nbrItems.value = data.length;
            })
        } catch (e) {
            store.errorMessage = e.message;
        } finally {
            isLoading.value = false;
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
    <span v-if="!isReady">
        <Loader />
    </span>
    <span v-else>
        <div class="stats">
            <span>{{ nbrItems }} items</span>
            <span>{{ store.countActive() }} Active</span>
            <span>{{ store.countCompleted() }} Completed</span> 
            <span><input type="checkbox" v-model="hideCompleted"/> Active</span>
        </div>
        <div v-for="item in store.tasks" :key="item.id">
            <TodoListIem 
            :id="item.id"
            :title="item.title"
            :is_completed="item.is_completed"
            :hideCompleted="hideCompleted"
        />
        </div>
    </span>
</template>

<style scoped>
    .stats {
        display: flex;
        justify-content: space-between;
        padding: 1rem 0.5rem;
        background-color: #efefef;
        margin-bottom: 0.5rem;
    }
</style>