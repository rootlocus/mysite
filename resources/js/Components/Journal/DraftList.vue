<template>
    <div class="border-2 border-red-300 text-green-560 rounded p-1 mb-2 mx-4 w-11/12 md:w-1/2 flex justify-between" v-for="entry in entries" :key="entry">
        <div @click="edit(entry)" class="flex items-baseline space-x-4 cursor-pointer">
            <h2 class="title font-bold text-xl">{{ entry.title }}</h2>
            <h3 class="content font-medium">{{ entry.category.name }}</h3>
            <h3 class="content font-medium text-right"><i>{{ entry.created_at }}</i></h3>
        </div>
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
            //TODO; page doesnt refresh upon deleting
            swal({
                title: "Are you sure you want to delete entry ?",
                icon: "warning",
                buttons: ["Cancel", "Delete"],
                dangerMode: false,
            })
            .then((isConfirm) => {
                if (isConfirm) {
                    this.$inertia.delete(route('journal.destroy', entry.id), null, {
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