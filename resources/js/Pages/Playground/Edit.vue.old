<template>
    <Head title="Create Entry"/>
    <div class="min-h-screen w-screen bg-black flex flex-col justify-top items-center pt-20">
        <JournalTitle />
        <p class="text-green-550">Edit Entry</p>
        <EntryForm v-if="entry" :entry="entry" :categories="categories.data" :action="'update'"/>
    </div>
</template>
<script>
import { Head } from '@inertiajs/inertia-vue3';
import JournalTitle from "@/Components/Journal/Title";
import EntryForm from "@/Components/Journal/EntryForm";

export default {
    components: {
        Head,
        JournalTitle,
        EntryForm,
    },
    props: {
        entry: {
            type: Object,
            default: () => {}
        },
        categories: {
            type: Object,
            default: () => {}
        },
        filters: {
            type: Object,
            default: () => {}
        },
    },
    data() {
        return {
            content: null,
        }
    },
    methods: {
    },
}
</script>