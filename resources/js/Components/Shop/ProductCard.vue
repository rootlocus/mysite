<template>
    <div class="bg-gray-600 h-64 border border-gray-600 hover:opacity-60">
        <div class="bg-white">
            <img src="https://fakeimg.pl/200/" class="mx-auto">
        </div>
        <div class="p-2 text-xs text-gray-300 font-semibold">
            <p>{{ name }}</p>
            <p>{{ currency }} {{ price }}</p>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        name: {
            type: String,
            default: 'N/A'
        },
        price: {
            type: Number,
            default: 'N/A'
        },
        currency: {
            type: String,
            default: 'RM',
        }
    },
}
</script>