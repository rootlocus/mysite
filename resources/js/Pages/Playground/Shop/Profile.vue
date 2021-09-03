<template>
    <div class="min-h-screen bg-white pt-12">
        <Navbar class="mb-2" :cart="cart"/>
        <div class="bg-gray-300 flex flex-col p-4 lg:mx-96 md:mx-10 mt-5">
            <div class="border-1 border-b-4 border-black">
                <h2 class="text-4xl">My Profile</h2>
            </div>
            <div class="p-2 flex space-x-10">
                <div class="mb-4 w-1/2">
                    <label
                        class="block text-gray-700 text-sm font-normal mb-2"
                        for="username"
                    >
                        Name
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        name="name"
                        v-model="user.name"
                        type="name"
                        required
                        autofocus
                        placeholder="Name"
                        disabled
                    />
                </div>
                <div class="mb-4  w-1/2">
                    <label
                        class="block text-gray-700 text-sm font-normal mb-2"
                        for="email"
                    >
                        Email
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        name="email"
                        v-model="user.email"
                        required
                        autofocus
                        placeholder="Email"
                        disabled
                    />
                </div>
            </div>
        </div>

        <!-- <div class="flex flex-col lg:mx-96 md:mx-10 mt-5">
            <div class="flex">
                <div>
                    adasd
                </div>
            </div>
        </div> -->
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
    computed: {
        user() {
            return this.$page.props.auth.user;
        }
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