<template>
    <div class="min-h-screen bg-white pt-12">
        <Navbar class="mb-2"/>
        <div class="flex flex-row lg:mx-40 md:mx-10">
            <div class="md:w-64 w-2/12">
                <div class="bg-gray-300 h-full flex flex-col p-4 space-y-10">
                    <div>
                        <span>
                            <b>Categories</b>
                        </span>
                        <div class="flex flex-col space-y-2" v-for="category in categories">
                            <span @click="filterCategory(category)">{{ category.name }}</span>
                        </div>
                    </div>
                    <div>
                        <span>
                            <b>Price Range</b>
                        </span>
                        <div class="flex flex-col font-semibold">
                            Minimum Price<input type="text" name="min" placeholder="Min">
                            Maximum Price<input type="text" name="min" placeholder="Max">
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-10/12 flex flex-col">
                <div class="flex flex-row items-center pl-2">
                    Search <input v-model="filters.search" @keyup="search" type="text" name="min" placeholder="Search Products" class="border border-black rounded-xl p-1 m-2 w-full">
                </div>
                <FilterTags :filters="filters"/>
                <div class="flex flex-wrap h-1/3">
                    <div v-for="product in products.data" class="w-1/5">
                        <ProductCard class="m-4" :name="product.name" :price="product.price" :currency="'RM'"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from '@/Components/Shop/Navbar';
import ProductCard from '@/Components/Shop/ProductCard';
import FilterTags from '@/Components/Shop/FilterTags';
import { debounce } from 'lodash';

export default {
    components: {
        Navbar,
        ProductCard,
        FilterTags,
    },
    props: {
        products: {
            type: Object,
            default: {}
        },
        categories: {
            type: Object,
            default: {}
        },
        filters: {
            type: Object,
            default: {}
        }
    },
    data() {
        return {
        }
    },
    mounted () {
    },
    methods: {
        search: debounce( function() {
            this.$inertia.get(route('playground.shop.index'), this.filters, { preserveState: true });
        }, 300),
        filterCategory: debounce( function(category) {
            this.filters.category = category.name;
            this.$inertia.get(route('playground.shop.index'), this.filters, { preserveState: true });
        }, 200),
        // clearAll
        // removeCategory
        // clear search
    },

}
</script>