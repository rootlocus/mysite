<template>
    <div class="min-h-screen bg-white pt-12">
        <Navbar class="mb-2"/>
        <div class="flex flex-row lg:mx-40 md:mx-10 border border-red-600">
            <div class="md:w-64 w-2/12">
                <div class="bg-gray-600 h-full">
                    Filter here
                </div>
            </div>
            <div class="flex flex-wrap h-1/3 w-10/12">
                <div v-for="x in y" class="w-1/5">
                    <ProductCard class="m-4" :name="'PRODUCT A'" :price="'RM 99.99'"/>
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