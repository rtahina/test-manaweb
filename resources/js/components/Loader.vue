<script setup>
    import rocket from '../images/loader.gif';
</script>

<template>
    <div class="loader">
        <img :src="rocket" alt="Loading" width="50px" height="auto" />
    </div>
</template>

<style scoped>
    .loader {
        padding: 2rem;
        text-align: center;
    }
</style>