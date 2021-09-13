<template>
    <Head title="Create Entry"/>
    <div class="min-h-screen w-screen bg-black flex flex-col justify-top items-center pt-20">
        <div class="w-full text-center">
            <h1 class="text-green-550 title text-8xl computer">Journal</h1>
            <h3 class="text-white">Add Entry</h3>
        </div>
        <div class="w-1/2 my-5 p-1 rounded bg-white" v-if="journal">
            <input v-model="journal.title" type="text" name="min" placeholder="Enter your title" class="border border-gray-400 p-2 m-1 mb-4 w-full">
            <DropdownSelect label='Categories' :items="categories.data" :selected="1" @select="select"/>
            <TipTap :modelValue="journal.content" @update:model-value="journal.content = $event"/>
            <div class="flex items-center space-x-4">
                <button :disabled="!isOwner" class="p-2 mt-2 bg-gray-750 text-white rounded disabled:opacity-50 disabled:cursor-not-allowed" @click="submitEntry">Submit</button>
                <div v-if="!isOwner">Only owner can submit an entry</div>
            </div>
        </div>
    </div>
</template>
<script>
import { Head } from '@inertiajs/inertia-vue3';
import TipTap from '@/Components/TipTap';
import DropdownSelect from '@/Components/DropdownSelect';

export default {
    components: {
        Head,
        TipTap,
        DropdownSelect,
    },
    props: {
        categories: {
            type: Object,
            default: () => {}
        },
        title: {
            type: String,
            default: ''
        }
    },
    computed: {
        isOwner() {
            return !!this.$page.props.auth.user && this.$page.props.auth.user.email === 'erickokkuan@gmail.com'; 
        }
    },
    mounted () {
        if (this.title) {
            this.journal.title = this.title;
        }
    },
    data() {
        return {
            content: null,
            journal: {
                title: null,
                content: null,
                category: null,
            }
        }
    },
    methods: {
        select(category) {
            this.journal.category = category;
        },
        updateContent(content) {
            this.journal.content = content;
        },
        submitEntry() {
            this.$inertia.post(route('journal.store'), this.journal, {
                onSuccess: page => { this.onSuccess('Entry added');},
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