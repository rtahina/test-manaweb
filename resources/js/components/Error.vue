<script setup>
    const props = defineProps({
        message: {
            type: String,
            default: ''
        }
    });
</script>

<template>
    <div v-show="message !== ''" class="error">{{ message }}</div>
</template>

<style scoped>
    .error {
        border: 2px solid rgb(199, 37, 37);
        padding: 0.5rem;
        text-align: center;
        margin:1rem;
        color: rgb(199, 37, 37);
        border-radius: 10px;
    }
</style>