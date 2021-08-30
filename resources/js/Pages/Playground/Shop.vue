<template>
    <div class="min-h-screen bg-white pt-12">
        <Navbar class="mb-2"/>
        <div class="flex flex-row lg:mx-40 md:mx-10 border border-red-600">
            <div class="md:w-64 w-2/12">
                <div class="bg-gray-600 h-full">
                    Filter list here
                </div>
            </div>
            <div class="w-10/12 flex flex-col">
                <div>
                    <span>Filter Tags: </span>
                    <button class="bg-gray-400 p-0.5 px-1 rounded-lg text-xs mx-1">
                        <span class="flex items-center space-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-2 w-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            <span>Category A</span>
                        </span>
                    </button>
                </div>
                <div class="flex flex-wrap h-1/3">
                    <div v-for="x in y" class="w-1/5">
                        <ProductCard class="m-4" :name="'PRODUCT A'" :price="'RM 99.99'"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from '@/Components/Shop/Navbar';
import ProductCard from '@/Components/Shop/ProductCard';

export default {
    components: {
        Navbar,
        ProductCard,
    },
    props: {

    },
    data() {
        return {
            y: [ 1, 2, 3, 4, 5, 6, 7,8,9,10,11,12,13,14,15,1, 2, 3, 4, 5, 6, 7,8,9,10,11,12,13,14,15]
        }
    },
    mounted () {
    },
    methods: {
        name() {
            
        }
    },

}
</script>