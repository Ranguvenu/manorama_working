<template>
    <div class="filters-wrapper mt-2 p-2" v-if="show">
        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12 py-3">
            <div class="sm:col-span-6">
                <MultiSelect
                    v-model="filters.author"
                    placeholder="Select Author"
                    returns="id"
                    :options="data.authors"
                    label="name"
                    :multiple="false"
                />
            </div>
            <div class="sm:col-span-6">
                <select
                    style="border-radius: 0.4rem; border: 1px solid #d9d9d9"
                    id="status"
                    class="mt-1 block w-full border-0.5"
                    v-model="filters.status"
                >
                    <option value="">Select Status</option>
                    <option v-for="(status,index) in data.statuses" :value = index >{{ status }}</option>
                </select>
            </div>
        </div>  
        <div class="ms-2 mt-2 flow-root">
            <div class="float-right">
                <Button size="sm" color="primary" v-on:click="$emit('filter')"
                    >Filter</Button
                >
                <ButtonOutline
                    size="sm"
                    color="primary"
                    v-on:click="$emit('reset')"
                    >Reset</ButtonOutline
                >
            </div>
        </div>
    </div>
</template>
<script>
import Button from "@/Components/Button.vue";
import ButtonOutline from "@/Components/ButtonOutline.vue";
import MultiSelect from "@/Components/MultiSelect.vue";

export default {
    props: {
        filters: {
            type: Object,
            required: true,
        },
        data: {
            type: Object,
            required: false,
        },
        show: {
            type: Boolean,
            required: true,
        },
        data: {
            type: Object,
            required: false,
        },
    },
    components: {
        Button,
        ButtonOutline,
        MultiSelect,
    },
    data() {
        return {};
    },
    methods: {
        filter(key, value, emit = true) {
            emit ? this.$emit("filter") : false;
        },
    },
    mounted() {},
};
</script>
