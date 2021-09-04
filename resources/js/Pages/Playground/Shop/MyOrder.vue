<template>
    <Head title="My Orders"/>

    <div class="min-h-screen bg-white pt-12">
        <Navbar class="mb-2" :cart="cart"/>
        <div class="flex flex-col lg:mx-96 md:mx-10 mt-5">
            <div class="flex flex-row space-x-10 mb-10">
                <div class="bg-gray-300 w-full flex flex-col p-4">
                    <div class="border-1 border-b-4 border-black">
                        <h2 class="text-4xl">My Orders</h2>
                    </div>
                    <div class="flex flex-col border-double border-b-4 border-black mt-2" v-for="item in orders" :key="item.id" v-if="Object.keys(orders).length > 0">
                        <div class="flex justify-between">
                            <span class="text-2xl font-semibold">Order #{{ item.id }} ({{item.status}}) <span class="text-xs">{{ item.status_timestamp }}</span></span>
                            <div class="flex cursor-pointer hover:text-blue-800 space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                <span class="font-bold">Statement</span>
                            </div>
                        </div>
                        <span class="mb-4"><b>Placed at:</b> {{ item.order_placed_at }}</span>
                        <div class="flex flex-row font-bold space-x-2 mb-2 text-xs md:text-m">
                            <div class="w-6/12">Product Name</div>
                            <div class="w-2/12 text-center">Quantity</div>
                            <div class="w-2/12">Price({{currency}})</div>
                            <div class="w-2/12">Total({{currency}})</div>
                        </div>
                        <div @click="viewProductPage(item.product.id)" class="flex flex-row space-x-2 mb-2 text-gray-700 cursor-pointer hover:text-blue-800 font-semibold hover:bg-blue-200 text-xs md:text-m" v-for="item in item.items" :key="item.id">
                            <div class="w-6/12">{{ item.product.name }}</div>
                            <div class="w-2/12 text-center">{{ item.quantity }}</div>
                            <div class="w-2/12">{{ item.price }}</div>
                            <div class="w-2/12">{{ item.total_amount }}</div>
                        </div>
                        <div class="border-1 border-t-4 border-black flex flex-row pt-2 space-x-6 mb-10 text-xs md:text-m">
                            <div class="w-10/12 font-bold">Order Total({{currency}}):</div>
                            <div class="w-2/12">{{ item.total_amount }}</div>
                        </div>
                    </div>
                    <div class="w-1/2 h-full bg-gray-300 rounded border-2 border-black p-2 mt-2" v-else>
                        <h2 >You don't have any orders yet.</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from '@/Components/Shop/Navbar';
import BackButton from '@/Components/Shop/BackButton';
import { Link } from '@inertiajs/inertia-vue3'
import QuantityInput from '@/Components/Shop/QuantityInput';
import { Head } from '@inertiajs/inertia-vue3'

export default {
    components: {
        Head,
        Navbar,
        BackButton,
        Link,
        QuantityInput,
    },
    props: {
        cart: {
            type: Object,
            default: {}
        },
        orders: {
            type: Object,
            default: {}
        },
    },
    data() {
        return {
            currency: 'RM',
        }
    },
    mounted () {
    },
    methods: {
        viewProductPage(product) {
            this.$inertia.visit(route('playground.shop.product.show', product));
        }
    },

}
</script>