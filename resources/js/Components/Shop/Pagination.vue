<template>
    <div class="flex flex-col lg:flex-row justify-center lg:justify-end">
        <span class="flex items-center mr-4 text-sm">{{ data.total }} products found.</span>
        <span class="text-sm font-semibold mr-4">Page {{ data.current_page}} / {{data.last_page}} </span>
        <ul class="flex pl-0 list-none rounded my-2">
            <li v-if="data.current_page != 1">
                <a class="page-link" :href="data.first_page_url">
                    <div class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 text-black border-r-0 ml-0 rounded-l hover:bg-gray-600 hover:text-gray-300">
                        First
                    </div>
                </a>
            </li>
            <li v-if="data.prev_page_url">
                <a class="page-link" :href="data.prev_page_url">
                    <div class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 text-black border-r-0 ml-0 rounded-l hover:bg-gray-600 hover:text-gray-300">
                        Previous
                    </div>
                </a>
            </li>
            <li v-for="link in links" :key="link.label">
                <a class="page-link" :href="link.url">
                    <div :class="{'bg-gray-600 cursor-not-allowed text-gray-300 hover:bg-gray-600' : data.current_page == link.label}" class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 text-black border-r-0 hover:bg-gray-700 hover:text-gray-300">
                        {{ link.label }}
                    </div>
                </a>
            </li>
            <li v-if="data.next_page_url">
                <a class="page-link" :href="data.next_page_url">
                    <div class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 text-black rounded-r hover:bg-gray-600 hover:text-gray-300">
                        Next
                    </div>
                </a>
            </li>
            <li  v-if="data.current_page != data.last_page">
                <a class="page-link" :href="data.last_page_url">
                    <div class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 text-black rounded-r hover:bg-gray-600 hover:text-gray-300">
                        Last
                    </div>
                </a>
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    props: {
        data: {
            type: Object,
            default: () => {}
        },
    },
    mounted () {
        this.links = this.data.links.slice(this.data.current_page, 5 + this.data.current_page).filter(function (link) {
            return parseInt(link.label);
        });
    },
    data() {
        return {
            links: []
        }
    },
    methods: {
        getPaginationLinks() {
            this.links = this.data.links.slice(this.data.current_page, 5 + this.data.current_page).filter(function (link) {
                return parseInt(link.label);
            });
        }
    },
}
</script>