<template>
    <div class="min-h-screen bg-gray-850 pt-20">
        <div class="flex flex-row mx-60">
            <div class="w-1/6">
                <div class="bg-white h-screen">
                    Filter here
                </div>
            </div>
            <div class="mx-10 flex flex-col w-5/6 space-y-4">
                <div class="flex flex-row space-x-10 h-48" v-for="x in y">
                    <div class="bg-white w-1/5">
                        item 1
                    </div>
                    <div class="bg-red-400 w-1/5">
                    item 2
                    </div>
                    <div class="bg-blue-400 w-1/5">
                    item 3
                    </div>
                    <div class="bg-blue-400 w-1/5">
                    item 4
                    </div>
                    <div class="bg-blue-400 w-1/5">
                    item 5
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// import Test from '@/Components/Test';

export default {
    props: {

    },
    data() {
        return {
            y: [ 1, 2, 3, 4 ]
        }
    },
    mounted () {
    },
    methods: {
        name() {
            
        }
    },

}
</script>