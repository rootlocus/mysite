<template>
    <Head title="Steam DevLogs"/>
    <div class="min-h-screen bg-gray-850 pt-20">
        <div class="bg-gray-750 text-gray-300 mx-40 p-10">
            <h1 class="text-center text-4xl">Devlogs for E-Commerce</h1>
            <h2 class="title text-2xl">Objective</h2>
            <p>A sample of a simple ecommerce store with user login authentication. 
            </p>
            <h2 class="title text-2xl mt-4">Build</h2>
            <ul class="list-disc ml-4">
                <li>Laravel(inertia)</li>
                <li>Vuejs</li>
                <li>MySql Database</li>
            </ul>
        </div>
    </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Head,
    },
    data() {
        return {
            data: {
                steamid: null
            },
        }
    },
    mounted () {
    },
    methods: {
    },
}
</script>