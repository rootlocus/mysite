<template>
    <div class="text-black md:h-10 bg-gray-300 flex justify-between md:px-20 px-10 py-2">
        <div class="flex items-center space-x-4">
            <Link class="flex flex-col md:flex-row items-center space-x-2 hover:text-blue-800" href="/playground/shop">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Home</span>
            </Link>
            <Link v-if="isLogin" class="flex flex-col md:flex-row items-center space-x-2 hover:text-blue-800" href="/playground/shop/orders">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                </svg>
                <span>Orders</span>
            </Link>
            <Link v-if="!isLogin" class="flex flex-col md:flex-row items-center space-x-2 hover:text-blue-800" href="/playground/shop/login">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>Login</span>
            </Link>
            <button class="flex flex-col md:flex-row items-center hover:text-blue-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span class="pl-2">
                    <Link href="/playground/shop/cart">CART ({{ cart?.items_count ?? 0 }})</Link>
                </span>
            </button>
        </div>
        <div class="flex space-x-4">
            <Link v-if="isLogin" class="flex flex-col md:flex-row items-center space-x-2 hover:text-blue-800 space-2-x" href="/playground/shop/profile">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>
                Profile
                </span>
            </Link>
            <button v-if="isLogin" class="flex flex-col md:flex-row items-center space-x-2 hover:text-blue-800" @click="logout">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Logout</span>
            </button>
        </div>
    </div>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link,
    },
    computed: {
        isLogin() {
            return !!this.$page.props.auth.user;
        }
    },
    props: {
        cart: {
            type: Object,
            default: () => {}
        },
    },
    methods: {
        logout() {
            this.$toast.success(`You are now logged out!`, { duration: 6000});
            this.$inertia.post(route('shop.logout'));
        }
    },
}
</script>