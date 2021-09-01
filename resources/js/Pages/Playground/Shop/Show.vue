<template>
    <div class="min-h-screen bg-white pt-12">
        <Navbar class="mb-2" :cart="cart"/>
        <div class="flex flex-col lg:mx-40 md:mx-10 mt-20">
            <BackButton class="mb-2"/>
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
                    <QuantityInput :quantity="cartItem?.quantity" @remove="removeItem" @add="addItem" @update="updateCart"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from '@/Components/Shop/Navbar';
import BackButton from '@/Components/Shop/BackButton';
import QuantityInput from '@/Components/Shop/QuantityInput';
import { Link } from '@inertiajs/inertia-vue3';
import { debounce } from 'lodash';

export default {
    components: {
        Navbar,
        Link,
        BackButton,
        QuantityInput,
    },
    props: {
        product: {
            type: Object,
            default: {}
        },
        cart: {
            type: Object,
            default: {}
        },
        cartItem: {
            type: Object,
            default: {}
        }
    },
    data() {
        return {
            currency: 'RM'
        }
    },
    mounted () {
    },
    methods: {
        addItem: debounce (function() {
            this.updateCart(null, 'add');
            this.$toast.success(`Product Added!`, { duration: 3000});
        }, 100),
        removeItem: debounce (function() {
            this.updateCart(null, 'remove');
            this.$toast.show(`Product Removed!`, { duration: 3000});
        }, 100),
        updateCart: debounce( function(quantity = null, type = null) {
            this.$inertia.put(route('playground.shop.product.add', this.product.id), {quantity: quantity, type: type, cart: this.cart.id}, { replace: true });
        })
    },

}
</script>