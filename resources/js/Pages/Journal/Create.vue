<template>
    <Head title="Create Entry"/>
    <div class="min-h-screen w-screen bg-black flex flex-col justify-top items-center pt-20">
        <div class="w-full text-center">
            <h1 class="text-white title text-8xl">Journal</h1>
            <h3 class="text-white">Add Entry</h3>
        </div>

        <div class="w-1/2 my-5 p-1 rounded bg-white">
            <input type="text" name="min" placeholder="Enter your title" class="border border-gray-400 p-2 m-1 mb-4 w-full">
            <TipTap :modelValue="content"/>
            <button class="p-2 mt-2 bg-gray-750 text-white rounded">Submit</button>
        </div>
    </div>
</template>
<script>
import { Head } from '@inertiajs/inertia-vue3';
import TipTap from '@/Components/TipTap';

export default {
    components: {
        Head,
        TipTap,
    },
    data() {
        return {
            content: null
        }
    },
}
</script>