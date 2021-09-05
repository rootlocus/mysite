<template>
    <Head title="Login Shop"/>
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
                        Login Now
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
                            @keyup.enter="login"
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
                            @keyup.enter="login"
                        />
                        </div>
                        <div class="flex items-center justify-between">
                            <button class="px-4 py-2 rounded text-white inline-block shadow-lg bg-blue-500 hover:bg-blue-600 focus:bg-blue-700" @click="login">
                                Sign In
                            </button>
                            <a
                                class="inline-block align-baseline font-normal text-sm text-blue-500 hover:text-blue-800"
                                href="/playground/shop/forgot-password"
                            >
                                Forgot Password?
                            </a>
                        </div>
                        <div>
                            <a
                                class="inline-block align-baseline font-normal text-sm text-blue-500 hover:text-blue-800"
                                href="/playground/shop/register"
                            >
                                Don't have account? Register Now
                            </a>
                        </div>
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
                email: null,
                password: null,
            }
        }
    },
    methods: {
        login() {
            this.$inertia.post(route('shop.login.post'), this.form, 
            {
                onSuccess: page => { this.onSuccess('You logged in!');},
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