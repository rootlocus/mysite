<template>
    <div class="min-h-screen bg-white pt-12">
        <Navbar class="mb-2"/>
        <div class="flex flex-col lg:mx-40 md:mx-10 mt-20">
            <div class="mx-40 text-xl">
                <Link href="/playground/shop">Back</Link>
            </div>
            <div class="flex flex-row">
                <div class="bg-white-500 w-1/2 shadow-xl">
                    <img src="https://fakeimg.pl/500/" class="mx-auto">
                </div>
                <div class="bg-gray-300 w-1/2 flex flex-col p-4">
                    <h2 class="title text-4xl">{{ product.name }}<span class="content text-xl pl-2">{{ product.category.name}}</span></h2>
                    <h3 class="text-5xl">{{currency}} {{ product.price }} </h3>
                    <div class="mt-4">
                        <h3 class="text-xl text-bold">Description</h3>
                        <p>{{ product.description }}</p>
                    </div>
                    <div class="text-2xl pt-4">
                        Quantity
                    </div>
                    <div class="flex flex-row">
                        <button class="bg-gray-750  px-4 text-gray-300">-</button>
                        <input type="number" class="w-20">
                        <button class="bg-gray-750  px-4 text-gray-300">+</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from '@/Components/Shop/Navbar';
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Navbar,
        Link,
    },
    props: {
        product: {
            type: Object,
            default: {}
        },
    },
    data() {
        return {
            currency: 'RM'
        }
    },
    mounted () {
    },
    methods: {
  
    },

}
</script>