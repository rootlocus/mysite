<template>
    <div>
        <label :for="label" class="pr-2">{{ label }}:</label>
        <select v-model="selected" @change="select(selected)" class="bg-black">
            <option disabled value="">Please Select</option>
            <option v-for="item in items" :key="item.id" :value="item.id">{{ item.value }}</option>
        </select>
    </div>
</template>
<script>
export default {
    props: {
        label: {
            type: String,
            default: ''
        },
        items: {
            type: Array,
            default: () => []
        },
        selected: {
            type: String || Number,
            default: null
        },
    },
    data() {
        return {
            chosen: null
        }
    },
    mounted () {
        this.chosen = this.selected.id;
    },
    methods: {
        select(value) {
            this.$emit('select', value);
        }
    },
}
</script>