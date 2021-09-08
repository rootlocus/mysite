<template>
    <div class="border-1 border-b-4 border-black mb-4">
        <h2 class="text-4xl title">Address Book</h2>
    </div>
    <div v-for="(address, index) in addresses" :key="address.id">
        <div class="bg-gray-300 shadow-md mb-4 p-4 px-6 rounded">
            <div class="flex space-x-4">
                <div class="mb-4 w-1/2">
                    <label
                        class="block text-gray-850 text-sm font-normal mb-2"
                        for="name"
                    >
                        Address Name
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-850 leading-tight focus:outline-none focus:shadow-outline"
                        name="name"
                        v-model="address.name"
                        type="name"
                        required
                        autofocus
                        placeholder="Address Name"
                        :disabled="editToggle != index"
                    />
                </div>
                <div class="mb-4 w-1/2">
                    <label
                        class="block text-gray-850 text-sm font-normal mb-2"
                        for="contact_name"
                    >
                        Contact Name
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-850 leading-tight focus:outline-none focus:shadow-outline"
                        name="contact_name"
                        v-model="address.contact_name"
                        type="name"
                        required
                        autofocus
                        placeholder="Contact Name"
                        :disabled="editToggle != index"
                    />
                </div>
                <div class="mb-4 w-1/2">
                    <label
                        class="block text-gray-850 text-sm font-normal mb-2"
                        for="contact_phone_no"
                    >
                        Contact No.
                    </label>
                    <input
                        class="disabled:bg-gray-300 shadow appearance-none border-1 border-gray-200 rounded w-full py-2 px-3 text-gray-850 leading-tight focus:outline-none focus:shadow-outline"
                        name="contact_phone_no"
                        v-model="address.contact_phone_no"
                        type="tel"
                        required
                        autofocus
                        placeholder="Contact No"
                        :disabled="editToggle != index"
                    />
                </div>
            </div>
            <div class="flex space-x-4">
                <div class="mb-4 w-1/2">
                    <label
                        class="block text-gray-850 text-sm font-normal mb-2"
                        for="address"
                    >
                        Address Line
                    </label>
                    <textarea
                        class="disabled:bg-gray-300 resize-none shadow appearance-none border-1 border-gray-200 rounded w-full py-2 px-3 text-gray-850 leading-tight focus:outline-none focus:shadow-outline"
                        name="address_line"
                        v-model="address.address_line"
                        required
                        placeholder="Address Line"
                        cols="1" rows="4"
                        maxlength="150"
                        :disabled="editToggle != index"
                    />
                </div>
                <div class="mb-4">
                    <label
                        class="block text-gray-850 text-sm font-normal mb-2"
                        for="contact_name"
                    >
                        Postcode
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-850 leading-tight focus:outline-none focus:shadow-outline"
                        name="postcode"
                        v-model="address.postcode"
                        type="name"
                        required
                        autofocus
                        placeholder="Postcode"
                        :disabled="editToggle != index"
                    />
                </div>
                <div class="mb-4">
                    <label
                        class="block text-gray-850 text-sm font-normal mb-2"
                        for="state"
                    >
                        State
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-850 leading-tight focus:outline-none focus:shadow-outline"
                        name="state"
                        v-model="address.state"
                        type="name"
                        required
                        autofocus
                        placeholder="State"
                        :disabled="editToggle != index"
                    />
                </div>
                <div class="mb-4">
                    <label
                        class="block text-gray-850 text-sm font-normal mb-2"
                        for="country"
                    >
                        Country
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-850 leading-tight focus:outline-none focus:shadow-outline"
                        name="country"
                        v-model="address.country"
                        type="name"
                        required
                        autofocus
                        placeholder="country"
                        :disabled="editToggle != index"
                    />
                </div>
            </div>
            <div class="flex justify-between">
                <div class="flex space-x-2">
                    <button class="px-4 py-1 bg-gray-750 text-gray-300 hover:opacity-80 disabled:opacity-50 disabled:cursor-not-allowed rounded" @click="toggleEdit(index)">
                        Edit
                    </button>
                    <button class="px-4 py-1  text-red-600 hover:opacity-80 disabled:opacity-50 disabled:cursor-not-allowed rounded" @click="deleteAddress(address)">
                        Delete
                    </button>
                </div>
                <div v-if="editToggle == index">
                    <button @click="updateAddress(address)" class="px-4 py-1 bg-gray-750 text-gray-300 hover:opacity-80 disabled:opacity-50 disabled:cursor-not-allowed rounded">
                        Update
                    </button>
                </div>
            </div>
            <div>
                <label class="inline-flex items-center my-2">
                    <input type="checkbox" class="h-8 w-8 text-orange-600 rounded hover:bg-gray-300" v-model="address.is_default" @change="setDefault(address)">
                    <span class="ml-2 text-gray-700">Default Address</span>
                </label>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    components: {
    },
    props: {
        addresses: {
            type: Object,
            default: {},
        },
    },
    data() {
        return {
            editToggle: -1,
            selectedAddress: null,
        }
    },
    methods: {
        updateAddress(address) {
            this.$inertia.put(route('playground.shop.address.update', address.id), address, { 
                replace: true,
                onSuccess: page => { 
                    this.onSuccess(address.name + ', is updated');
                    this.editToggle = null;
                },
                onError: errors => { this.onError(errors);},
            });
        },
        deleteAddress(address) {
            this.$inertia.put(route('playground.shop.address.destroy', address.id), address, { 
                replace: true,
                onSuccess: page => { 
                    this.onSuccess(address.name + ', is deleted');
                    this.editToggle = null;
                },
                onError: errors => { this.onError(errors);},
            });
        },
        setDefault(address) {
            this.$inertia.put(route('playground.shop.address.setDefault', address.id), address, { 
                replace: true,
                onSuccess: page => { 
                    this.onSuccess(address.name + ', has been set as default');
                },
                onError: errors => { this.onError(errors);},
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
        toggleEdit (index) {
            if (this.editToggle === index) {
                this.editToggle = -1;
            } else {
                this.editToggle = index;
            }
        }
    },
}
</script>