<template>
    <Head title="Create Entry"/>
    <div class="min-h-screen w-screen bg-black flex flex-col justify-top items-center pt-20">
        <JournalTitle />
        <EntryForm v-if="entry" :entry="entry" :categories="categories.data"/>
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
        title: {
            type: String,
            default: ''
        }
    },
    mounted () {
        if (this.title) {
            this.entry.title = this.title;
        }
    },
    data() {
        return {
            content: null,
        }
    },
    methods: {
        // updateContent(content) {
        //     this.entry.content = content;
        // },
    },
}
</script>