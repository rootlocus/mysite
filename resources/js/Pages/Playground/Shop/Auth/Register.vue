<template>
    <Head title="Register"/>
    <div class="min-h-screen bg-white pt-12">
        <Navbar class="" />
        <div class="bg-gray-750 h-screen">
            <div class="flex items-center justify-center pt-10">
                <div class="w-full max-w-md">
                    <div class="bg-white shadow-lg rounded px-12 pt-6 pb-8 mb-4">
                        <!-- @csrf -->
                        <div
                        class="text-gray-800 text-2xl flex justify-center border-b-2 py-2 mb-4"
                        >
                        Register
                        </div>
                        <div class="mb-4">
                            <label
                                class="block text-gray-700 text-sm font-normal mb-2"
                                for="username"
                            >
                                Name
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                name="name"
                                v-model="form.name"
                                type="name"
                                required
                                autofocus
                                placeholder="Name"
                            />
                        </div>
                        <div class="mb-4">
                            <label
                                class="block text-gray-700 text-sm font-normal mb-2"
                                for="username"
                            >
                                Email
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                name="email"
                                v-model="form.email"
                                type="email"
                                required
                                autofocus
                                placeholder="Email"
                            />
                        </div>
                        <div class="mb-6">
                            <label
                                class="block text-gray-700 text-sm font-normal mb-2"
                                for="password"
                            >
                                Password
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                                v-model="form.password"
                                type="password"
                                placeholder="Password"
                                name="password"
                                required
                                autocomplete="current-password"
                            />
                        </div>
                        <div class="mb-6">
                            <label
                                class="block text-gray-700 text-sm font-normal mb-2"
                                for="password_confirmation"
                            >
                                Confirm Password
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                                v-model="form.password_confirmation"
                                type="password"
                                placeholder="Password Confirmation"
                                name="password_confirmation"
                                required
                                autocomplete="current-password"
                            />
                        </div>
                        <button class="flex justify-center w-full px-4 py-2 rounded text-white shadow-lg bg-blue-500 hover:bg-blue-600 focus:bg-blue-700" type="submit" @click="register">
                            <div id="loader" class="hidden pl-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                            </div>
                            Register
                        </button>
                        <!-- <div v-if="Object.keys($attrs.errors).length" class="text-red-500" v-for="errors in $attrs.errors">
                            * {{ errors }}
                        </div>
                        <div v-if="form.password_confirmation && form.password_confirmation != form.password" class="text-red-600">
                            Confirmed password does not match
                        </div> -->
                    </div>

                    <!-- <p class="text-center text-gray-500 text-xs">
                        &copy;2020 Gau Corp. All rights reserved.
                    </p> -->
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Navbar from '@/Components/Shop/Navbar';
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Navbar,
        Head,
    },
    data() {
        return {
            form: {
                name: null,
                email: null,
                password: null,
                password_confirmation1: null,
            },
            isRegistering: false,
            isLoading: false
        }
    },
    methods: {
        register() {
            this.$inertia.post(route('shop.register.store'), this.form,{
                onSuccess: page => { this.onSuccess('Successfully registered! Please check your email to complete verification.');},
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
    },
}
</script>