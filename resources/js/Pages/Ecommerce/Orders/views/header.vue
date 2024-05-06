<template>
    <div class="flex justify-between items-center w-100">
        <div>
            <div class="cursor-pointer flex" v-on:click="$emit('show-filters')">Filters
                <AdjustmentsHorizontalIcon class="ms-2 h-6 w-6 text-gray-1000" />
            </div>
        </div>
        <div class="flex items-center w-100">
            <input type="text" class="py-2 h-8 text-sm border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md shadow-sm" placeholder="Search Orders" v-model="filters.search" @input="filter('search', $event.target.value)" />
            <Button v-if="$has_capability('create-orders')" size="sm" color="primary" > 
                <a href='/ecommerce/orders/create'>Create Order</a>
            </Button>
        </div>
    </div>
</template>
<script>
    import { AdjustmentsHorizontalIcon } from '@heroicons/vue/24/solid';
    import Filters from "../filters/filters.vue";
    import Button from "@/Components/Button.vue";
export default{
        components:{
            Filters,
            AdjustmentsHorizontalIcon,
            Button           
        },
        props:{
            current: {
                type: Number,
                required: false,
                default: 0
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
