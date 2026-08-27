import { defineStore } from "pinia";
import { ref } from "vue";

export const toDoStore = defineStore('todos', () => {
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

    const progress = () => {
        const allTasks = tasks.value.length;
        const completed = countCompleted();
        
        return (completed * 100) / allTasks;
    }

    return { 
        addTodo, 
        todo, 
        tasks, 
        countActive, 
        countCompleted, 
        progress, 
        isLoading, 
        isReady, 
        errorMessage 
    };
});