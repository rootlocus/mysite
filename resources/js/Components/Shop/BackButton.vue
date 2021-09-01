<template>
    <div @click="goBack" class="cursor-pointer text-xl text-black flex space-x-2 items-center hover:text-blue-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        <span>Back</span>
    </div>
</template>
<script>
export default {
    components: {
    },
    methods: {
        goBack() {
            window.history.back();
        }
    },
}
</script>