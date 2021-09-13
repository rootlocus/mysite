<template>
    <Head title="Journal"/>
    <div class="flex flex-col justify-top items-center pt-20">
        <div class="w-full text-center mb-4">
            <h1 class="text-white title text-8xl">Journal</h1>
            <div class="flex flex-col justify-center items-center">
                <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 w-full justify-center items-center">
                    <input v-model="filters.search" @keyup="applyFilter" @keydown.enter="entries.data.length == 0 ? createDraft() : null" type="text" name="min" 
                        placeholder="Search" 
                        class="border border-gray-400 rounded-xl mr-2 w-10/12 md:w-1/3">
                    <button class="rounded bg-blue-700 p-2 text-white" @click="createDraft">Draft</button>
                </div>
                <span class="text-white" v-if="filters.search">found {{ entries.data.length }} search results</span>
                <span class="text-white" v-if="entries.data.length == 0">Hit "Enter" to create new entry</span>
            </div>
        </div>
        <div class="bg-white rounded p-4 mb-4 mx-4 w-11/12 md:w-1/2" v-for="entry in entries.data" :key="entry">
            <h2 class="title font-bold text-3xl">{{ entry.title }}</h2>
            <h3 class="content font-medium"><i>{{ entry.created_at }}</i></h3>
            <div class="mt-2 text-xs" v-html="entry.content"></div>
        </div>
    </div>
</template>

<style  module>
    pre {
        padding: 10px;
        margin-top: 20px !important;
        margin-bottom: 20px !important;
        --tw-bg-opacity: 1;
        background-color: rgba(209, 213, 219, var(--tw-bg-opacity));
        overflow-x: auto;
        overflow-y: auto;
    }
</style>


<script>
import { Head } from '@inertiajs/inertia-vue3';
import { debounce } from 'lodash';

export default {
    components: {
        Head,
    },
    props: {
        entries: {
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
        }
    },
    methods: {
        applyFilter: debounce( function() {
            this.$inertia.get(route('journal.index'), this.filters, { preserveState: true });
        }, 300),
        createDraft() {
            this.$inertia.get(route('journal.create'), {title: this.filters.search }, {
                onError: errors => { this.onError(errors);},
            });
        },
    },
}
</script>