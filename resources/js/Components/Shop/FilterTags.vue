<template>
    <div class="pl-2" v-if="filters.categories.length">
        <span>Filter Tags: </span>
        <button class="bg-gray-400 p-0.5 px-1 rounded-lg text-xs mx-1" v-for="category in filters.categories" @click="unfilter(category)">
            <span class="flex items-center space-x-1" @click="">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-2 w-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <span>{{ category }}</span>
            </span>
        </button>
    </div>
</template>
<script>
import {remove} from 'lodash'; 

export default {
    props: {
        filters: {
            type: Object,
            default: {}
        },
    },
    methods: {
        unfilter(category) {
            this.$emit('remove', category);
        }
    },
}
</script>