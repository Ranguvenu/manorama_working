<template>
    <div class="flex justify-end items-center w-100">
        <div class="flex items-center justify-items-end w-100">
            <input type="text" class="py-2 h-8 text-sm border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md shadow-sm" placeholder="Search Country Code" v-model="filters.search" @input="filter('search', $event.target.value)" />
            <CreateCountryCode :current="current" @close="$emit('close')" @refresh="$emit('refresh')"/>
        </div>
    </div>
</template>
<script>
    import { AdjustmentsHorizontalIcon } from '@heroicons/vue/24/solid';
    import Filters from "../filters/index.vue";
    import CreateCountryCode from '../create.vue';

    export default{
        components:{
            Filters,
            AdjustmentsHorizontalIcon,
            CreateCountryCode
        },
        props:{
            current: {
                type: Number,
                required: false,
                default: 0
            },
            countrycode:{
                type: Object,
                required: true
            },
            filters: {
                type: Object,
                required: true
            },
        },
        data(){
            return{

            }
        },
        methods:{
            filter(key, value, emit=true){
                emit ? this.$emit('filter') : false;
            },
        },
        mounted(){
            
        }
    }
</script>
