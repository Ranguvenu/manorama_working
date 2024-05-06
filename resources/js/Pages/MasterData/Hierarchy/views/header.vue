<template>
    <div class="flex justify-end items-center w-100">
        <div class="flex items-center justify-items-end w-100">
            <input type="text" class="py-2 h-8 text-sm border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md shadow-sm" placeholder="Search" v-model="filters.search" @input="filter('search', $event.target.value)" />
            <ButtonRegular v-if="$has_capability('create-hierarchy')" size="sm" color="primary" @click="$emit('create-hierarchy', {show: true, parent: 0, type: 1, label: 'Goal', depth: 0, extrafields: false})">Add Goal</ButtonRegular>
        </div>
    </div>
</template>
<script>
import { AdjustmentsHorizontalIcon } from '@heroicons/vue/24/solid';
import Filters from "../filters/index.vue";
import ButtonRegular from '@/Components/Button.vue';

export default{
    components:{
        Filters,
        ButtonRegular,
        AdjustmentsHorizontalIcon
    },
    props:{
        filters: {
            type: Object,
            required: true
        },  
    },
    methods:{
        filter(key, value, emit=true){
            emit ? this.$emit('filter') : false;
        },
    },
    watch: {

    }
}
</script>
