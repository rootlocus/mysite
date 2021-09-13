<template>
    <Head title="Journal"/>
    <div class="flex flex-col justify-top items-center pt-20">
        <div class="w-full text-center mb-4">
            <h1 class="text-green-550 title text-8xl computer">Journal</h1>
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
        <div class="border-2 border-gray-300 text-green-560 rounded p-4 mb-4 mx-4 w-11/12 md:w-1/2" v-for="entry in entries.data" :key="entry">
            <h2 class="title font-bold text-3xl">{{ entry.title }}</h2>
            <h3 class="content font-medium">{{ entry.category.name }}</h3>
            <div class="mt-2 text-xm mb-2" v-html="entry.content"></div>
            <h3 class="content font-medium text-right"><i>Logged {{ entry.created_at }}</i></h3>
            <div v-if="isOwner" class="flex justify-end space-x-2">
                <a @click="edit(entry)" class="cursor-pointer">Edit</a><a @click="deleteEntry(entry)" class="cursor-pointer">Delete</a>
            </div>
        </div>
    </div>
</template>

<style module>
    pre {
        padding: 10px;
        margin-top: 20px !important;
        margin-bottom: 20px !important;
        --tw-bg-opacity: 1;
        background-color: rgba(31,41,55, var(--tw-bg-opacity));
        overflow-x: auto;
        overflow-y: auto;
    }
    code {
         font-family: 'Courier New', Courier, monospace !important;
         color:rgb(177, 246, 255);
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
        categories: {
            type: Object,
            default: () => {}
        },
        filters: {
            type: Object,
            default: () => {}
        },
    },
    computed: {
        isOwner() {
            return !!this.$page.props.auth.user && this.$page.props.auth.user.email === 'erickokkuan@gmail.com'; 
        }
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
        edit(entry) {
            console.log('ENTER');
            this.$inertia.get(route('journal.edit', entry.id));
        },
        deleteEntry(entry) {
            this.$inertia.delete(route('journal.destroy', entry.id), null, {
                onSuccess: page => { this.onSuccess('Entry is deleted !');},
                onError: errors => { this.onError(errors);},
            });
        },
        onError(data) {
            for (let key in data) {
                this.$toast.error(data[key], {duration: false});
            }
        },
        onSuccess(msg) {
            this.$toast.success(msg, {duration: 3000});
        },
    },
}
</script>