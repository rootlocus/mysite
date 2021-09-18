<template>
    <div class="border-2 border-gray-300 text-green-560 rounded p-4 mb-4 mx-4 w-11/12 md:w-1/2" v-for="entry in entries" :key="entry">
        <h2 class="title font-bold text-3xl">{{ entry.title }} <span class="content font-medium text-xs">{{ entry.category.name }}</span></h2>
        <div class="mt-2 text-xm mb-2" v-html="entry.content"></div>
        <h5 class="content font-medium text-right"><i>Logged {{ entry.created_at }}</i></h5>
        <div v-if="isOwner" class="flex justify-end space-x-2">
            <a @click="edit(entry)" class="cursor-pointer">Edit</a><a @click="deleteEntry(entry)" class="cursor-pointer">Delete</a>
        </div>
    </div>
</template>
<script>
import swal from 'sweetalert';

export default {
    props: {
        entries: {
            type: Object,
            default: () => {}
        },
    },
    computed: {
        isOwner() {
            return !!this.$page.props.auth.user && this.$page.props.auth.user.email === 'erickokkuan@gmail.com'; 
        },
    },
    methods: {
        edit(entry) {
            this.$inertia.get(route('journal.edit', entry.id));
        },
        deleteEntry(entry) {
            swal({
                title: "Are you sure you want to delete entry ?",
                icon: "warning",
                buttons: ["Cancel", "Delete"],
                dangerMode: false,
            })
            .then((isConfirm) => {
                if (isConfirm) {
                    this.$inertia.delete(route('journal.destroy', entry.id), {
                        onSuccess: page => { this.onSuccess('Entry is deleted !');},
                        onError: errors => { this.onError(errors);},
                    });
                }
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