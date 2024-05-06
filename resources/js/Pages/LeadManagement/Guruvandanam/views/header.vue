<template>
    <div class="flex justify-end items-center w-100">
        <div class="flex items-center justify-items-end w-100">
            <input type="text" class="py-2 h-8 text-sm border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md shadow-sm" placeholder="Search" v-model="filters.search" @input="filter('search', $event.target.value)" />
     
        </div>
    </div>
</template>
<script>

    export default{
        components:{

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
            },
        },
        data(){
            return{

            }
        },
        methods:{
            filter(key, value, emit=true){
                emit ? this.$emit('filter') : false;
            }
        },
        mounted(){
            
        }
    }
</script>
