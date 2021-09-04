<template>
    <div class="flex space-x-2 mt-4">
        <div class="text-l">
            Quantity
        </div>
        <div class="flex flex-row hover:opacity-80 h-8 md:h-full">
            <button class="bg-gray-750  px-3 text-gray-300" @click="$emit('remove')">-</button>
            <input type="number" class="w-16 text-center pl-2  focus:bg-blue-200" v-model="quantity" @change="$emit('update', quantity)">
            <button class="bg-gray-750  px-3 text-gray-300" @click="$emit('add')">+</button>
        </div>
    </div>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link,
    },
    props: {
        quantity: {
            type: Number,
            default: 0
        },
    },
}
</script>