<template>
    <div class="flex justify-between items-center w-100">
        <div>
            <div class="cursor-pointer flex" v-on:click="$emit('show-filters')">Filters
                <AdjustmentsHorizontalIcon class="ms-2 h-6 w-6 text-gray-1000" />
            </div>
        </div>
        <div class="flex items-center w-100">
            <input type="text" class="py-2 h-8 text-sm border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md shadow-sm" :placeholder="'Search '+type.meta.plural" v-model="filters.search" @input="filter('search', $event.target.value)" />
            <CreateArticle :type="type" :current="current" @close="$emit('close')" @refresh="$emit('refresh')"/>
        </div>
    </div>
</template>
<script>
    import { AdjustmentsHorizontalIcon } from '@heroicons/vue/24/solid';
    import Filters from "../filters/index.vue";
    import CreateArticle from '../create.vue';

    export default{
        components:{
            Filters,
            AdjustmentsHorizontalIcon,
            CreateArticle
        },
        props:{
            current: {
                type: Number,
                required: false,
                default: 0
            },
            type:{
                type: Object,
                required: true
            },
            filters: {
                type: Object,
                required: true
            }
        },
        data(){
            return{

            }
        },
        methods: {
            filter(key, value, emit = true) {
                emit ? this.$emit("filter") : false;
            },
        },
        mounted(){
            
        }
    }
</script>
