import { defineStore } from "pinia";
import { ref } from "vue";

export const toDoStore = defineStore('todos', () => {
    const isNewItem = ref(false);
    const isLoading = ref(false);
    const isReady = ref(true);
    const errorMessage = ref('');
    const tasks = ref([]);
    
    const todo = ref({
        id:0,
        title: '',
        is_completed: false
    });

    const addTodo = (todoTitle) => {
        todo.value.title = todoTitle;
        tasks.push(todo)
    }

    const countCompleted = () => {
        const active = tasks.value.filter(item => {
            return item.is_completed;
        });

        return active.length;
    }

    const countActive = () => {
        const active = tasks.value.filter(item => {
            return item.is_completed === false;
        });

        return active.length;
    }

    return { addTodo, todo, tasks, countActive, countCompleted, isNewItem, isLoading, isReady, errorMessage };
});