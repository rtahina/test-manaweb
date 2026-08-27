<script setup>
    import { toDoStore } from "@/store/ToDoStore";
    import Error from "./Error.vue";

    const store = toDoStore();
    const { tasks, errorMessage } = store;

    const props = defineProps({
        id: {
            type: Number,
            required: true,
        },
        title: {
            type: String,
            required: true,
        },
        is_completed: {
            type: Boolean,
            default: false
        },
        hideCompleted: {
            type: Boolean,
            default: false
        }
    });

    const toggleComplete = (id) => {
        const url = `http://127.0.0.1:8000/api/tasks/${id}`;
        try {
            const data = fetch(url, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                }
            })
            .then(data => data.json())
            .then(data => {
                store.tasks.find((o, i) => {
                    if (o.id === id) {
                        store.tasks[i] = { 
                            id: o.id, 
                            title: o.title, 
                            is_completed: !o.is_completed 
                        };
                        return true;
                    }
                });
            })
        } catch (e) {
            store.errorMessage = e.message;
        } finally {
            store.errorMessage = '';
        }
    }
    
    const deleteTask = (id) => {
        const url = `http://127.0.0.1:8000/api/tasks/${id}`;
        try {
            const deletedId = id;
            const data = fetch(url, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                }
            })
            .then(data => data.json())
            .then(data => {
                const remainingTasks = store.tasks.filter(item => {
                    return item.id !== deletedId;
                });
                store.tasks = remainingTasks;
            })
        } catch (e) {
            store.errorMessage = e.message;
        } finally {
            store.errorMessage = '';
        }
    }
</script>

<template>        
    <span v-if="is_completed && hideCompleted">        
    </span>
    <span v-else class="todo-list-item">
        <input type="checkbox" @click="toggleComplete(id)" :checked="is_completed"/>
        <span :class="{ completed: is_completed }" 
            :title="'Click to mark as ' + (is_completed ? 'todo' : 'completed')">{{ title }}
        </span>
        <button @click="deleteTask(id)">Delete</button>
    </span>
</template>

<style scoped>
.todo-list-item {
    display: flex;
    margin-bottom: 0.2rem;
    border: 1px solid #ccc;
    padding: 0.5rem 0.5rem;
    font-weight: 500;
}
.todo-list-item:hover {
    background-color: #efefef;
    cursor: pointer;
}
.todo-list-item span {
    display: block;
    padding-left: 0.5rem;
    flex: 1;
}
.completed {
    font-weight: normal;
    text-decoration: line-through
}
</style>