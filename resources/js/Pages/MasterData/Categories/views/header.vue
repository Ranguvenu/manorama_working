<template>
    <div class="flex justify-end items-center w-100">
        <div class="flex items-center flex-wrap justify-items-end w-100">
            <input type="text"
                class="py-2 h-8 min-w-[300px] text-sm border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md shadow-sm"
                :placeholder="placeholder" v-model="filters.search" @input="filter('search', $event.target.value)" />
            <CreateCategory :taxonomy="taxonomy" :current="current" @close="$emit('close')" @refresh="$emit('refresh')"/>
        </div>
    </div>
</template>
<script>
    import { AdjustmentsHorizontalIcon } from '@heroicons/vue/24/solid';
    import Filters from "../filters/index.vue";
    import CreateCategory from '../create.vue';

    export default{
        components:{
            Filters,
            AdjustmentsHorizontalIcon,
            CreateCategory
        },
        props:{
            current: {
                type: Number,
                required: false,
                default: 0
            },
            taxonomy:{
                type: Object,
                required: true
            },
            filters: {
                type: Object,
                required: true,
            },
        },
        data(){
            return{  
                placeholder: ''
            }
        },
        methods:{
            filter(key, value, emit=true){
                emit ? this.$emit('filter') : false;
            },
        },
        mounted(){
            this.placeholder = "Search "+this.taxonomy.plural;
        }
    }
</script>
