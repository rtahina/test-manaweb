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
        border: 2px solid red;
        padding: 0.5rem;
        text-align: center;
        margin:1rem;
        color: red;
    }
</style>