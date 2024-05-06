<template>
    <div class="filters-wrapper p-4 mt-2" v-if="show">
        <div class="">
            <input type="text" class="border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md shadow-sm" placeholder="Search Resources" v-model="filters.search" @input="filter('search', $event.target.value)"/>
        </div>
        <div class="ms-2 mt-2 flow-root">
            <div class="float-right">
                <!-- <Button size="sm" color="primary" v-on:click="$emit('filter')">Filter</Button>
                <ButtonOutline size="sm" color="primary" v-on:click="$emit('reset')">Reset</ButtonOutline> -->
            </div>
        </div>
    </div>
</template>
<script>
    import Button from '@/Components/Button.vue';
    import ButtonOutline from '@/Components/ButtonOutline.vue';
    export default{
        props: {
            filters: {
                type: Object,
                required: true
            },
            data: {
                type: Object,
                required: false
            },
            show:{
                type: Boolean,
                required: true
            }
        },
        components:{
            Button,
            ButtonOutline        
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
