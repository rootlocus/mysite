<template>
    <Head title="Journal"/>
    <div class="flex flex-col justify-top items-center pt-20">
        <div class="w-full mb-4">
            <JournalTitle />
            <div class="flex flex-col justify-center items-center">
                <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 w-full justify-center items-center">
                    <input v-model="filters.search" @keyup="applyFilter" @keydown.enter="entries.data.length == 0 ? createDraft() : null" type="text" name="min" 
                        placeholder="Search" 
                        class="border border-gray-400 rounawded-xl mr-2 w-10/12 md:w-1/3">
                    <button class="rounded bg-blue-700 p-2 text-white" @click="createDraft">Draft</button>
                </div>
                <span class="text-white" v-if="filters.search">found {{ entries.data.length }} search results</span>
                <span class="text-white" v-if="entries.data.length == 0">Hit "Enter" to create new entry</span>
            </div>
        </div>
        <h2 class="text-2xl text-green-550 title" v-if="isOwner && drafts.length > 0">Drafts</h2>
        <DraftList :entries="drafts" v-if="isOwner && drafts.length > 0"/>
        <h2 class="text-2xl text-green-550 mt-4 title">Entries</h2>
        <EntryList :entries="nondrafts"/>
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
    pre > code {
         font-family: 'Courier New', Courier, monospace !important;
         color:rgb(177, 246, 255);
    }

    p > code {
      background-color: darkslategray;
      color: orange;
      padding:4px;
    }
    
    ul > li {
        padding: 0px;
        margin: 0 1rem;
        color:#90db60;
        list-style-type: disc;
    }

    ol > li {
        padding: 0px;
        margin: 0 1rem;
        color:#90db60;
        list-style-type: decimal;
    }

    p {
      line-height: 1.1;
      margin-top: 0.75em !important;
    }

    p > a {
        text-decoration: underline;
        color: blue;
    }
</style>


<script>
import { Head } from '@inertiajs/inertia-vue3';
import { debounce } from 'lodash';
import JournalTitle from "@/Components/Journal/Title";
import EntryList from "@/Components/Journal/EntryList";
import DraftList from "@/Components/Journal/DraftList";

export default {
    components: {
        Head,
        JournalTitle,
        EntryList,
        DraftList,
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
    data() {
        return {
            drafts: {},
            nondrafts: {},
        }
    },
    watch: {
        filters(newValue, oldValue) {
            this.initializeData();
        }
    },
    computed: {
        isOwner() {
            return !!this.$page.props.auth.user && this.$page.props.auth.user.email === 'erickokkuan@gmail.com'; 
        },
    },
    mounted () {
        this.initializeData();
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
        onError(data) {
            for (let key in data) {
                this.$toast.error(data[key], {duration: false});
            }
        },
        onSuccess(msg) {
            this.$toast.success(msg, {duration: 3000});
        },
        initializeData() {
            this.drafts = this.entries.data.filter( entry => {
                return entry.is_draft === true;
            });
            this.nondrafts = this.entries.data.filter( entry => {
                return entry.is_draft === false;
            });
        }
    },
}
</script>