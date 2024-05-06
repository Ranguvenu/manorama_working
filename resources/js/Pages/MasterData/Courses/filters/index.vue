<template>
    <div class="filters-wrapper p-6 mt-2 relative rounded-md" v-if="show">
        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12 py-3">
            <div class="sm:col-span-4">
                <MultiSelect v-model="filters.goal" placeholder="Select Goal" returns="id" :options="data.goals"
                    label="title" :multiple="false" />
            </div>
            <div class="sm:col-span-4">
                <MultiSelect v-model="filters.board" placeholder="Select Board" returns="id" :options="data.boards"
                    label="title" :multiple="false" />
            </div>
            <div class="sm:col-span-4">
                <MultiSelect v-model="filters.classes" placeholder="Select Class" returns="id" :options="data.classes"
                    label="title" :multiple="false" />
            </div>
        </div>
        <div class="flow-root">
            <div class="float-right">
                <Button size="sm" color="primary" v-on:click="$emit('filter')">Filter</Button>
                <ButtonOutline size="sm" color="primary" v-on:click="$emit('reset')">Reset</ButtonOutline>
            </div>
        </div>
    </div>
</template>
<script>
import Button from '@/Components/Button.vue';
import ButtonOutline from '@/Components/ButtonOutline.vue';
import MultiSelect from '@/Components/MultiSelect.vue';
export default {
    props: {
        filters: {
            type: Object,
            required: true
        },
        data: {
            type: Object,
            required: false
        },
        show: {
            type: Boolean,
            required: true
        },
    },
    components: {
        Button,
        ButtonOutline,
        MultiSelect
    },
    data() {

    },
    methods: {
        filter(key, value, emit = true) {
            emit ? this.$emit('filter') : false;
        },
    },
    mounted() {
    }
}
</script>
