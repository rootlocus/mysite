<template>
    <div class="w-full md:w-1/2 my-5 p-1 rounded bg-black border border-green-550">
        <input v-model="entry.title" type="text" name="min" placeholder="Enter your title" class="border border-gray-400 p-2 m-1 mb-4 w-full">
        <DropdownSelect label='Categories' :items="categories" :selected="entry.category.id" @select="select" class="text-green-550"/>
        <TipTap :modelValue="entry.content" @update:model-value="entry.content = $event"/>
        <div class="flex items-center space-x-4">
            <button 
                :disabled="!isOwner" 
                class="p-2 mt-2 border border-gray-750 text-green-550 rounded disabled:opacity-50 disabled:cursor-not-allowed" 
                @click="submit">
                {{ action == 'update' ? 'Update' : 'Submit'}}
            </button>
            <div v-if="!isOwner">Only owner can submit an entry</div>
        </div>
    </div>
</template>
<script>
import TipTap from '@/Components/TipTap';
import DropdownSelect from '@/Components/DropdownSelect';

export default {
    components: {
        TipTap,
        DropdownSelect,
    },
    props: {
        entry: {
            type: Object,
            default: () => {}
        },
        categories: {
            type: Array,
            default: () => {}
        },
        action: {
            type: String,
            default: () => {}
        }
    },
    computed: {
        isOwner() {
            return !!this.$page.props.auth.user && this.$page.props.auth.user.email === 'erickokkuan@gmail.com'; 
        }
    },
    methods: {
        select(category) {
            this.entry.category.id = category;
        },
        submit() {
            if (this.action === 'update') {
                this.updateEntry();
            } else {
                this.submitEntry();
            }
        },
        submitEntry() {
            this.$inertia.post(route('journal.store'), this.entry, {
                onSuccess: page => { this.onSuccess('Entry added');},
                onError: errors => { this.onError(errors);},
            });
        },
        updateEntry() {
            let params = {
                content: this.entry.content,
                title: this.entry.title,
                category_id: this.entry.category.id,
            };
            this.$inertia.put(route('journal.update', this.entry.id), params, {
                onSuccess: page => { this.onSuccess('Entry updated');},
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