<script setup>
    import { toDoStore } from "@/store/ToDoStore";

    const store = toDoStore();
    const { progress } = store;
</script>

<template>
    <div class="progress">
        <div>{{Math.round(store.progress())}}%</div>
        <span class="progress-bar">
            <span class="completion" :style="`width: ${store.progress()}%`"></span>
        </span>
        <div>{{ store.countActive() }} tâche à faire</div>
    </div>
</template>

<style scoped>
    .progress {
        padding: 0.5rem;
        text-align: center;
        margin:1rem;

        .progress-bar {
            display: block;
            width: 100%;
            background-color: #efefef;
            margin-top: 0.5em;
        }

        .completion {
            display: block;
            padding: 3px;
            background-color: blue;
        }
    }
</style>