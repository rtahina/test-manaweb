<template>
    <div class="todo">
        <h2>ToDo</h2>
        <ToDoForm/>
        <div class="todo-list-wrapper">
            <ToDoList />
        </div>
    </div>
</template>

<script setup>
    import { ref, defineAsyncComponent } from 'vue'
    import ToDoForm from "./ToDoForm.vue";

    const ToDoList = defineAsyncComponent(() =>
        import('./ToDoList.vue')
    );
</script>

<style scoped>
    .todo {
        width: 50%;
        margin: 0 auto;
        padding: 0.5rem;
    }
    h2 {
        font-size: 2rem;
        font-weight: 600;
        text-align: center;
    }
    .todo-list-wrapper {
        display: block;
        border: 2px solid #aaa;
        padding: 0.5rem;
    }
</style>