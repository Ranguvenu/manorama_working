<template>
    <div class="filters-wrapper p-6 mt-2 relative rounded-md" v-if="show">
        <div class="">
            <input type="text" class="border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md shadow-sm" :placeholder="placeholder" v-model="filters.search" @input="filter('search', $event.target.value)"/>
        </div>
        <div class="filter-submit absolute">
            <!-- <Button size="sm" color="primary" v-on:click="$emit('filter')">Filter</Button>
            <ButtonOutline size="sm" color="primary" v-on:click="$emit('reset')">Reset</ButtonOutline> -->
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
        show: {
            type: Boolean,
            required: true
        },
    },
    components:{
        Button,
        ButtonOutline
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
    }
}
</script>
