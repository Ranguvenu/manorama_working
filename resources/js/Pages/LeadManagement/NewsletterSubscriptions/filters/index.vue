<template>
    <div class="filters-wrapper p-6 mt-2 relative rounded-md" v-if="show">
        <div class="">
            <input type="text" class="border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md shadow-sm" placeholder="Search Subscriber Email" v-model="filters.search" @input="filter('search', $event.target.value)"/>
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
