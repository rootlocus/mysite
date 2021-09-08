<template>
    <div>
        <div class="flex flex-col p-1 lg:mx-72 md:mx-10 mb-4 rounded">
            <div class="flex">
                <button @click="isToggle = !isToggle" class="bg-gray-850 p-2 text-gray-300 hover:opacity-80 disabled:opacity-50 disabled:cursor-not-allowed rounded">
                    Add Address
                </button>
            </div>
        </div>
        <div v-if="isToggle" class="bg-gray-300 flex flex-col p-4 lg:mx-72 md:mx-10 rounded border-2 border-black">
            <div>
                <div class="border-1 border-b-4 border-black">
                    <h2 class="text-4xl title">Add Address</h2>
                </div>
                <div class="flex flex-col mt-2">
                    <div class="flex space-x-4">
                        <div class="mb-4 w-1/2">
                            <label
                                class="block text-gray-700 text-sm font-normal mb-2"
                                for="name"
                            >
                                Address Name
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                name="name"
                                v-model="address.name"
                                type="name"
                                required
                                autofocus
                                placeholder="Address Name"
                            />
                        </div>
                        <div class="mb-4 w-1/2">
                            <label
                                class="block text-gray-700 text-sm font-normal mb-2"
                                for="contact_name"
                            >
                                Contact Name
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                name="contact_name"
                                v-model="address.contact_name"
                                type="name"
                                required
                                autofocus
                                placeholder="Contact Name"
                            />
                        </div>
                        <div class="mb-4 w-1/2">
                            <label
                                class="block text-gray-700 text-sm font-normal mb-2"
                                for="contact_phone_no"
                            >
                                Contact No.
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                name="contact_phone_no"
                                v-model="address.contact_phone_no"
                                type="tel"
                                required
                                autofocus
                                placeholder="Contact No"
                            />
                        </div>
                    </div>
                    <div class="flex space-x-4">
                        <div class="mb-4 w-1/2">
                            <label
                                class="block text-gray-700 text-sm font-normal mb-2"
                                for="address"
                            >
                                Address Line
                            </label>
                            <textarea
                                class="resize-none shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                name="address_line"
                                v-model="address.address_line"
                                required
                                placeholder="Address Line"
                                cols="1" rows="4"
                                maxlength="150"
                            />
                        </div>
                        <div class="mb-4">
                            <label
                                class="block text-gray-700 text-sm font-normal mb-2"
                                for="contact_name"
                            >
                                Postcode
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                name="postcode"
                                v-model="address.postcode"
                                type="name"
                                required
                                autofocus
                                placeholder="Postcode"
                            />
                        </div>
                        <div class="mb-4">
                            <label
                                class="block text-gray-700 text-sm font-normal mb-2"
                                for="state"
                            >
                                State
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                name="state"
                                v-model="address.state"
                                type="name"
                                required
                                autofocus
                                placeholder="State"
                            />
                        </div>
                        <div class="mb-4">
                            <label
                                class="block text-gray-700 text-sm font-normal mb-2"
                                for="country"
                            >
                                Country
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                name="country"
                                v-model="address.country"
                                type="name"
                                required
                                autofocus
                                placeholder="Country"
                            />
                        </div>
                    </div>
                    <div class="flex space-x-4">
                        <button class="px-2 py-1 bg-gray-750 text-gray-300 hover:opacity-80 disabled:opacity-50 disabled:cursor-not-allowed rounded" @click="add">
                            Add
                        </button>
                        <button class="px-2 py-1  text-red-600 hover:opacity-80 disabled:opacity-50 disabled:cursor-not-allowed rounded" @click="clear">
                            Clear
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col lg:mx-72 md:mx-10 mt-4" v-if="Object.keys(addresses).length > 0">
            <AddressList :addresses="addresses"/>
        </div>
        <div v-else class="bg-gray-300 flex flex-col p-4 lg:mx-72 md:mx-10 mt-2 px-10 rounded border-2 border-black">
            <h2 @click="isToggle = !isToggle">Sorry, you don't have any addresses. Begin to add addresses now.</h2>
        </div>
    </div>
</template>

<script>
import Navbar from '@/Components/Shop/Navbar';
import BackButton from '@/Components/Shop/BackButton';
import { Link, Head } from '@inertiajs/inertia-vue3'
import QuantityInput from '@/Components/Shop/QuantityInput';
import AddressList from  '@/Components/Shop/AddressList';

export default {
    components: {
        Navbar,
        BackButton,
        Link,
        Head,
        QuantityInput,
        AddressList,
    },
    props: {
        addresses: {
            type: Object,
            default: {}
        }
    },
    computed: {
        user() {
            return this.$page.props.auth.user;
        }
    },
    data() {
        return {
            currency: 'RM',
            address: {
                name: null,
                contact_name: null,
                contact_phone_no: null
            },
            isToggle: false
        }
    },
    mounted () {
    },
    methods: {
        add() {
            this.$inertia.post(route('playground.shop.address.store'), this.address, { 
                replace: true,
                onSuccess: page => { 
                    this.onSuccess('Address Added!');
                    this.clear();
                },
                onError: errors => { this.onError(errors);},
            });
            
        },
        clear() {
            Object.keys(this.address).forEach(key => this.address[key]=null);
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