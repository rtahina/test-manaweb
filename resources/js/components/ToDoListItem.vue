<script setup>
    import { toDoStore } from "@/store/ToDoStore";
   
    const store = toDoStore();
    const { isReady, errorMessage, hideCompleted } = store;

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
        }
    });

    const toggleComplete = (id) => {
        const url = `http://127.0.0.1:8000/api/tasks/${id}`;
        try {
            const data = fetch(url, {
                method: 'PATCH',
                headers: {
                    'Accept': 'application/json',
                    'Accept': 'application/json',
                }
            })
            .then(data => data.json())
            .then(data => {
                if (data.errors) {
                    store.errorMessage = data.message;
                } else {
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
                }
            })
        } catch (e) {
            store.errorMessage = e.message;
        } finally {
            store.isReady = true;
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
                if (data.errors) {
                    store.errorMessage = data.message;
                } else {
                    const remainingTasks = store.tasks.filter(item => {
                        return item.id !== deletedId;
                    });
                    store.tasks = remainingTasks;
                }
            })
        } catch (e) {
            store.errorMessage = e.message;
        } finally {
            store.isReady = true;
        }
    }
    
</script>

<template>
    
    <span class="todo-list-item" :class="{hide: (is_completed && store.hideCompleted)}">
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
    margin-bottom: 0.5rem;
    border: 1px solid #ccc;
    padding: 1rem 1.5rem;
    font-weight: 500;
    background-color: #ddd;
    border-radius: 10px;

    button {
        border: none;
        outline: none;
        box-shadow: none;
        width: 20px;
        height: 20px;
        background: url(../images/bin.png) center center no-repeat;
        background-size: contain;
        overflow: hidden;
        text-indent: -9999px;
    }
}
.todo-list-item:hover {
    background-color: #efefef;
}
.todo-list-item span {
    display: block;
    padding-left: 0.5rem;
    flex: 1;
}
.completed {
    font-weight: normal;
    color: #999;
}

.hide {
    display: none;
}
</style>