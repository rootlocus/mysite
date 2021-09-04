<template>
    <Head title="Steam DevLogs"/>
    <div class="min-h-screen bg-gray-850 pt-20">
        <div class="bg-gray-750 text-gray-300 mx-60 p-10">
            <h1 class="text-center text-4xl">Devlogs for Steam Infographics</h1>
            <h2 class="title text-2xl">Objective</h2>
            <p>To build somewhat of an interesting infographics for people who have play their games using Steam./n 
                Currently it is still a work in progress to decide what to do with the data that steam provides.
            </p>
            <h2 class="title text-2xl mt-4">Build</h2>
            <ul class="list-disc ml-4">
                <li>Laravel(inertia)</li>
                <li>Vuejs</li>
                <li>API: https://steamcommunity.com/dev</li>
                <li>Chart library https://www.npmjs.com/package/@j-t-mcc/vue3-chartjs</li>
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