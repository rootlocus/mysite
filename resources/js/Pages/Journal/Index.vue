<template>
    <Head title="Journal"/>
    <div class="bg-black h-full flex flex-col justify-top items-center pt-20">
        <div class="w-full text-center">
            <h1 class="text-white title text-8xl">Journal</h1>
            <div class="flex flex-col justify-center items-center mx-136">
                <span class="text-white hidden">found 200 search results</span>
                <input type="text" name="min" placeholder="Search" class="border border-gray-400 rounded-xl p-2 m-2 w-full">
            </div>
        </div>

        <div class="bg-white my-5 p-4 px-8 mx-60 rounded w-1/2" v-for="entry in entries" :key="entry">
            <h2 class="title font-bold text-3xl">{{ entry.title }}</h2>
            <h3 class="content font-medium"><i>{{ entry.created_at }}</i></h3>
            <div class="mt-2" v-html="entry.content"></div>
        </div>
    </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Head,
    },
    props: {
        entries: {
            type: Object,
            default: () => {}
        },
    },
    data() {
        return {
            x: [1,2,3,4]
        }
    },
}
</script>