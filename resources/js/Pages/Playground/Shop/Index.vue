<template>
    <Head title="Home"/>
    <div class="min-h-screen bg-white pt-12">
        <Navbar class="mb-2" :cart="cart"/>
        <div class="flex flex-row xl:mx-40 md:mx-10">
            <div class="md:w-64 w-2/12 hidden md:block xl:block">
                <div class="bg-gray-300 h-screen flex flex-col p-4 space-y-10">
                    <div>
                        <span>
                            <b>Categories</b>
                        </span>
                        <div class="flex flex-col space-y-2 cursor-pointer hover:text-blue-800" v-for="category in categories" :key="category.id">
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
                        <button class="p-0.5 px-2 mt-2 bg-gray-600 text-gray-300 rounded" @click="filter">Filter</button>
                        <button class="p-0.5 ml-2 px-2 mt-2  text-gray-600" @click="clearPrice">Clear</button>
                    </div>
                </div>
            </div>
            <div class="xl:w-10/12 md:w-10/12 flex flex-col">
                <div class="flex flex-row items-center pl-2">
                    Search <input v-model="filters.search" @keyup="filter" type="text" name="min" placeholder="Search Products" class="border border-gray-400 rounded-xl p-1 m-2 w-full">
                </div>
                <FilterTags :filters="filters" @remove="removeCategory" class="flex flex-row items-center pl-2"/>
                <Pagination :data="products" class="flex flex-row items-center pl-2"/>
                <div class="flex flex-wrap cursor-pointer mx-4 lg:mx-0">
                    <div v-for="product in products.data" :key="product.id" class="2xl:w-1/5 xl:w-1/3 l:w-1/2 md:w-1/2 w-full">
                        <ProductCard class="m-4" :name="product.name" :price="product.price" :currency="'RM'"  @click="viewDetails(product.id)"/>
                    </div>
                </div>
                <Pagination class="flex flex-row items-center pl-2 mb-10" :data="products"/>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from '@/Components/Shop/Navbar';
import ProductCard from '@/Components/Shop/ProductCard';
import FilterTags from '@/Components/Shop/FilterTags';
import Pagination from '@/Components/Shop/Pagination';
import { debounce } from 'lodash';
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Head,
        Navbar,
        ProductCard,
        FilterTags,
        Pagination,
    },
    props: {
        products: {
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
        cart: {
            type: Object,
            default: () => {}
        },
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
            if (this.filters.categories.indexOf(category.name) < 0) {
                this.filters.categories.push(category.name);
                this.filter();
            }
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
        },
        viewDetails(product) {
            this.$inertia.visit(route('playground.shop.product.show', product));
        }
    },

}
</script>