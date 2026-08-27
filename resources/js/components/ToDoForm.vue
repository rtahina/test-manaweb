<script setup>
    import { ref } from 'vue';
    import { toDoStore } from "@/store/ToDoStore";
    import Error from "./Error.vue";

    const newTodoItem = ref('');
    const store = toDoStore();
    const { errorMessage, isReady } = store;

    const addNewTask = () =>{
        store.errorMessage = '';
        const url = `http://127.0.0.1:8000/api/tasks/`;
        const patchData = {
            title: newTodoItem.value
        };
        try {
            const data = fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(patchData)
            })
            .then(data => data.json())
            .then(data => {
                if (data.errors) {
                    store.errorMessage = data.message;
                } else {
                    store.tasks.push(data);
                    newTodoItem.value = '';
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
     <Error 
        :message="store.errorMessage"
    />
    <form @submit.prevent="">
        <input type="text" v-model="newTodoItem" required />
        <button @click="addNewTask">Add</button>
    </form>
</template>

<style scoped>
    form {
        margin: 1rem auto;
        display: flex;
        flex-direction: row;
    }
    input {
        flex: 1;
    }
</style>