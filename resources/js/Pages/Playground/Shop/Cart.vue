<template>
    <div class="min-h-screen bg-white pt-12">
        <Navbar class="mb-2"/>
        <div class="flex flex-col lg:mx-40 md:mx-10 mt-20">
            <div class="mx-40 text-xl">
                <Link href="/playground/shop">Back</Link>
            </div>
            <div class="flex flex-row space-x-10">
                <div class="w-1/2">
                    <div class="bg-white-500 text-4xl pb-4">Shopping Bag</div>
                    <div class="border-1 border-b-4 border-black">
                        <h3 class="text-2xl">
                        10 ITEM
                        </h3>
                    </div>
                    <div class="flex flex-row space-x-4 pb-2" v-for="x in y">
                        <img src="https://fakeimg.pl/200/" class="">
                        <div>
                            <p>PRODUCT A</p>
                            <p>PRICE: RM 1000.00</p>
                            <div>
                                <div class="text-2xl pt-4">
                                    Quantity
                                </div>
                                <div class="flex flex-row">
                                    <button class="bg-gray-750  px-4 text-gray-300">-</button>
                                    <input type="number" class="w-20">
                                    <button class="bg-gray-750  px-4 text-gray-300">+</button>
                                </div>
                            </div>
                            <button>Remove</button>
                        </div>
                    </div>

                </div>

                <div class="bg-gray-300 w-1/2 flex flex-col p-4 ">
                    <div class="border-1 border-b-4 border-black">
                        <h2 class="text-4xl">Order Summary</h2>
                    </div>
                    <div class="flex flex-col space-y-4">
                        <div class="text-m">Product A: RM 100.00</div>
                        <div class="text-m">Shipping Cost: RM 100.00</div>
                        <div class="border-1 border-t-4 border-black">
                            <div class="text-m">Order Total: RM 100.00</div>
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
import { Link } from '@inertiajs/inertia-vue3'

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
            currency: 'RM',
            y: [1,2,3,4]
        }
    },
    mounted () {
    },
    methods: {
  
    },

}
</script>