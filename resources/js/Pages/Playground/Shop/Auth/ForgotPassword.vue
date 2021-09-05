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
                        <p v-if="isSubmited" class="bg-gray-400 mt-2 p-2">
                            A link to reset your password has been sent to your email.
                        </p>
                        <div v-if="!isSubmited" class="mb-4 mt-2">
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
                        <button :disabled="isLoading || !form.email" v-if="!isSubmited" @click="reset" class="disabled:opacity-50 disabled:bg-blue-500 disabled:cursor-not-allowed w-full flex px-4 py-2 rounded text-white shadow-lg bg-blue-500 hover:bg-blue-600 focus:bg-blue-700" type="submit">
                            <div class="pl-2" v-if="isLoading">
                                <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                            </div>
                            <span class="mx-auto">Email Password Reset Link</span>
                        </button>
                    </form>
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
            },
            isLoading: false,
            isSubmited: false,
        }
    },
    methods: {
        reset() {
            this.isLoading = true;
            this.$inertia.post(route('password.email'), this.form, {
                onSuccess: page => { 
                    this.isSubmited = true;
                    this.onSuccess('You logged in!'); 
                },
                onError: errors => { 
                    this.isSubmited = false;
                    this.isLoading = false;
                    this.onError(errors); 
                },
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