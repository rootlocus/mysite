<template>
    <Head title="Forgot Password"/>
    <div class="min-h-screen bg-white pt-12">
        <Navbar class="" />
        <div class="bg-gray-750 h-screen">
            <div class="flex items-center justify-center pt-10">
                <div class="w-full max-w-md">
                    <form class="bg-white shadow-lg rounded px-12 pt-6 pb-8 mb-4">
                        <!-- @csrf -->
                        <div
                        class="text-gray-800 text-2xl flex justify-center border-b-2 py-2 mb-4"
                        >
                        Forgot Password
                        </div>
                        <p>
                            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                        </p>
                        <div class="mb-4 mt-2">
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

                        <button class="w-full px-4 py-2 rounded text-white inline-block shadow-lg bg-blue-500 hover:bg-blue-600 focus:bg-blue-700" type="submit">Email Password Reset Link</button>
                    </form>
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
        Head
    },
    data() {
        return {
            form: {
                email: null,
            }
        }
    },
}
</script>