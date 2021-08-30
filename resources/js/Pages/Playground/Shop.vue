<template>
    <div class="min-h-screen bg-white pt-12">
        <Navbar class="mb-2"/>
        <div class="flex flex-row lg:mx-40 md:mx-10">
            <div class="md:w-64 w-2/12">
                <div class="bg-gray-300 h-screen flex flex-col p-4 space-y-10">
                    <div>
                        <span>
                            <b>Categories</b>
                        </span>
                        <div class="flex flex-col space-y-2 cursor-pointer" v-for="category in categories">
                            <span @click="filterCategory(category)">{{ category.name }}</span>
                        </div>
                    </div>
                    <div>
                        <span>
                            <b>Price Range</b>
                        </span>
                        <div class="flex flex-col font-semibold">
                            Minimum Price<input type="text" name="min" placeholder="Min" v-model="filters.minPrice" class="rounded-xl px-2">
                            Maximum Price<input type="text" name="min" placeholder="Max" v-model="filters.maxPrice" class="rounded-xl px-2">
                        </div>
                        <button class="p-0.5 px-2 mt-2 bg-gray-600 text-gray-300 rounded-xl" @click="filter">Filter</button>
                        <button class="p-0.5 ml-2 px-2 mt-2  text-gray-600 rounded-xl" @click="clearPrice">Clear</button>
                    </div>
                </div>
            </div>
            <div class="w-10/12 flex flex-col">
                <div class="flex flex-row items-center pl-2">
                    Search <input v-model="filters.search" @keyup="filter" type="text" name="min" placeholder="Search Products" class="border border-black rounded-xl p-1 m-2 w-full">
                </div>
                <FilterTags :filters="filters" @remove="removeCategory"/>
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
        filter: debounce( function() {
            this.$inertia.get(route('playground.shop.index'), this.filters, { preserveState: true });
        }, 300),
        filterCategory: debounce( function(category) {
            this.filters.categories.push(category.name);
            this.filter();
        }, 200),
        removeCategory(removedCategory) {
            this.filters.categories = this.filters.categories.filter(function(category) {
                return category != removedCategory;
            });
            this.filter();
        },
        clearPrice() {
            this.filters.minPrice = null;
            this.filters.maxPrice = null;
            this.filter();
        }
    },

}
</script>