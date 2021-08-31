<template>
    <div class="text-xl text-black flex space-x-2 items-center hover:text-blue-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        <Link :href="link" >Back</Link>
    </div>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link,
    },
    props: {
        link: {
            type: String,
            default: {}
        },
    },
}
</script>