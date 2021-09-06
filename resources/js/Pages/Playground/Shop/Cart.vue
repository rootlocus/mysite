<template>
    <Head title="My Cart"/>
    <div class="min-h-screen bg-white pt-12">
        <Navbar class="mb-2" :cart="cart"/>
        <div class="flex flex-col lg:mx-40 md:mx-10 mt-5 mx-10">
            <div class="bg-white-500 text-4xl pb-4">Shopping Bag</div>
            <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-10 mb-10">
                <div class="md:w-1/2"  v-if="Object.keys(cart.items).length > 0">
                    <div class="border-1 border-b-4 border-black flex flex-row space-x-4 items-center">
                        <h3 class="text-2xl">{{ cart.items_count }} ITEM(S)</h3>
                        <h4 class="hover:text-red-600 cursor-pointer" @click="clearAll" v-if="cart.items_count">Clear All</h4>
                    </div>
                    <div class="flex flex-row space-x-4 pt-2" v-for="item in cart.items" :key="item.id">
                        <img src="https://fakeimg.pl/200/" class="md:w-1/2 h-20 md:h-auto">
                        <div class="md:w-1/2">
                            <p>{{ item.name }}</p>
                            <p>PRICE: {{currency}} {{ item.price }} </p>
                            <QuantityInput :quantity="item.quantity" @remove="removeItem(item.product)" @add="addItem(item.product)" @update="updateCart($event, null ,item.product)"/>
                            <button class="text-red-600" @click="clearProduct(item.product)">Remove</button>
                        </div>
                    </div>
                </div>
                <div class="w-1/2 h-full bg-gray-300 rounded border-2 border-black p-2" v-else>
                    <h2 >You don't have any items in your cart.</h2>
                </div>
                <div class="bg-gray-300 md:w-1/2 flex flex-col p-4 ">
                    <div class="border-1 border-b-4 border-black">
                        <h2 class="text-xl md:text-4xl">Address</h2>
                    </div>
                    <div v-for="line in address">
                        <p>
                            {{ line }}
                        </p>
                    </div>
                    <div class="border-1 border-b-4 border-black">
                        <h2 class="text-xl md:text-4xl">Order Summary</h2>
                    </div>
                    <div class="flex flex-col space-y-4 text-xs md:text-l xl:text-xl">
                        <div class="flex flex-row font-semibold space-x-2">
                            <div class="w-6/12">Product Name</div>
                            <div class="w-2/12 text-center">Quantity</div>
                            <div class="w-2/12">Price({{currency}})</div>
                            <div class="w-2/12">Total({{currency}})</div>
                        </div>
                        <div v-for="item in cart.items" :key="item.id" class="flex flex-row space-x-2">
                            <div class="w-6/12">{{ item.product.name }}</div>
                            <div class="w-2/12 text-center">{{ item.quantity }}</div>
                            <div class="w-2/12">{{ item.price }}</div>
                            <div class="w-2/12">{{ item.total_amount }}</div>
                        </div>
                        <div class="border-1 border-t-4 border-black flex flex-row pt-2 space-x-6">
                            <div class="w-10/12 font-bold">Order Total({{currency}}):</div>
                            <div class="w-2/12">{{ cart.total_amount }}</div>
                        </div>
                        <button class="p-1 md:p-4 bg-gray-750 text-gray-300 text-xl hover:opacity-80 disabled:opacity-50 disabled:cursor-not-allowed rounded" @click="checkout" :disabled="!cart.items_count">
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
import { Link } from '@inertiajs/inertia-vue3'
import QuantityInput from '@/Components/Shop/QuantityInput';
import { debounce } from 'lodash';
import swal from 'sweetalert';
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Navbar,
        Link,
        Head,
        QuantityInput,
    },
    props: {
        cart: {
            type: Object,
            default: {}
        },
        address: {
            type: Array,
            default: []
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
            this.$inertia.put(route('playground.shop.cart.update', this.cart.id), {quantity: quantity, type: type, product: product}, { 
                preserveState: true,
                onSuccess: page => {
                    if (type === null) {
                        quantity === 0 ? this.$toast.show(`Product removed from cart!`, { duration: 3000}) : this.$toast.success(`Product quantity updated!`, { duration: 3000})
                    } else if (type === 'add') {
                        this.$toast.success(`Product Added!`, { duration: 3000});
                    } else if (type === 'remove') {
                        this.$toast.show(`Product Removed!`, { duration: 3000});
                    }
                },
                onError: errors => { this.onError(errors);},
            });
        }),
        clearProduct(product) {
            this.$inertia.delete(route('playground.shop.cart.product.destroy', {'cart': this.cart.id, 'product': product.id}), { 
                preserveState: true,
                onSuccess: page => { this.onSuccess(product.name + ` is removed from cart`);},
                onError: errors => { this.onError(errors);},
            });
        },
        clearAll() {
            this.$inertia.delete(route('playground.shop.cart.clearAll', {'cart': this.cart.id}), null, { 
                preserveState: true,
                onSuccess: page => { this.onSuccess('Cart is cleared!');},
                onError: errors => { this.onError(errors);},
            });
        },
        checkout() {
            swal({
                title: "Are you sure you want to checkout ?",
                icon: "warning",
                buttons: ["Cancel", "Checkout"],
                dangerMode: false,
            })
            .then((isConfirm) => {
                if (isConfirm) {
                    this.$inertia.post(route('playground.shop.cart.checkout', this.cart.id));
                }
            });
        },
        onError(data) {
            for (let key in data) {
                this.$toast.error(data[key], {duration: false});
            }
        },
        onSuccess(msg) {
            this.$toast.success(msg, {duration: 3000});
        },
    },

}
</script>