<template>
    <div class="bg-gray-600 h-64 border border-red-600">
        <div class="bg-white">
            <img src="https://fakeimg.pl/200/" class="mx-auto">
        </div>
        <div class="p-2 text-xs">
            <p>{{ name }}</p>
            <p>{{ price }}</p>
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
            type: String,
            default: 'N/A'
        }
    },
}
</script>