<template>
    <div class="min-h-screen bg-white pt-12">
        <Navbar class="mb-2" :cart="cart"/>
        <div class="flex flex-col lg:mx-40 md:mx-10 mt-5">
            <BackButton :link="'/playground/shop'" class="mb-5"/>
            <div class="bg-white-500 text-4xl pb-4">Shopping Bag</div>
            <div class="flex flex-row space-x-10 mb-10">
                <div class="w-1/2">
                    <div class="border-1 border-b-4 border-black flex flex-row space-x-4 items-center">
                        <h3 class="text-2xl">{{ cart.items_count }} ITEM(S)</h3>
                        <h4 class="hover:text-red-600 cursor-pointer" @click="clearAll" v-if="cart.items_count">Clear All</h4>
                    </div>
                    <div class="flex flex-row space-x-4 pt-2" v-for="item in cart.items" :key="item.id">
                        <img src="https://fakeimg.pl/200/" class="">
                        <div>
                            <p>{{ item.name }}</p>
                            <p>PRICE: {{currency}} {{ item.price }} </p>
                            <QuantityInput :quantity="item.quantity" @remove="removeItem(item.product)" @add="addItem(item.product)" @update="updateCart($event, null ,item.product)"/>
                            <button @click="clearProduct(item.product)">Remove</button>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-300 w-1/2 flex flex-col p-4 ">
                    <div class="border-1 border-b-4 border-black">
                        <h2 class="text-4xl">Order Summary</h2>
                    </div>
                    <div class="flex flex-col space-y-4">
                        <div class="flex flex-row font-semibold">
                            <div class="w-6/12">Product Name</div>
                            <div class="w-2/12 text-center">Quantity</div>
                            <div class="w-2/12">Price({{currency}})</div>
                            <div class="w-2/12">Total({{currency}})</div>
                        </div>
                        <div v-for="item in cart.items" :key="item.id" class="flex flex-row">
                            <div class="w-6/12">{{ item.product.name }}</div>
                            <div class="w-2/12 text-center">{{ item.quantity }}</div>
                            <div class="w-2/12">{{ item.price }}</div>
                            <div class="w-2/12">{{ item.total_amount }}</div>
                        </div>
                        <div class="border-1 border-t-4 border-black flex flex-row pt-2">
                            <div class="w-10/12 font-bold">Order Total({{currency}}):</div>
                            <div class="w-2/12">{{ cart.total_amount }}</div>
                        </div>
                        <button class="p-4 bg-gray-750 text-gray-300">
                            Checkout Now
                        </button>
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
import { debounce } from 'lodash';

export default {
    components: {
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
    },
    data() {
        return {
            currency: 'RM',
        }
    },
    mounted () {
    },
    methods: {
        addItem: debounce (function(item) {
            this.updateCart(null, 'add', item);
        }, 100),
        removeItem: debounce (function(item) {
            this.updateCart(null, 'remove', item);
        }, 100),
        updateCart: debounce( function(quantity = null, type = null, product = null) {
            this.$inertia.put(route('playground.shop.cart.update', this.cart.id), {quantity: quantity, type: type, product: product}, { preserveState: true });
        }),
        clearProduct(product) {
            this.$inertia.delete(route('playground.shop.cart.product.destroy', {'cart': this.cart.id, 'product': product.id}), null, { preserveState: true });
        },
        clearAll() {
            this.$inertia.delete(route('playground.shop.cart.clearAll', {'cart': this.cart.id}), null, { preserveState: true });
        }
    },

}
</script>