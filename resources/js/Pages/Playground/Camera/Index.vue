<template>
    <Head title="Camera"/>
    <div class="min-h-screen bg-white pt-12">

    </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Head,
    },
    props: {
        products: {
            type: Object,
            default: {}
        },
    },
}
</script>