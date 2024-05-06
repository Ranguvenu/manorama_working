<template>
    <div class="filters-wrapper p-6 mt-2 relative rounded-md" v-if="show">
        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12 py-3">
            <div class="sm:col-span-4">
                <input type="date" class="w-full border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md shadow-sm text-sm" v-model="filters.date"/>
            </div>
            <div class="sm:col-span-4">
                <select class="border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md w-full" v-model="filters.status">
                    <option value="-1">All Users</option>
                    <option value="1">Active Users</option>
                    <option value="2">Idle Users</option>
                    <option value="3">Suspended Users</option>
                </select>
            </div>
            <div class="sm:col-span-4">
                <select class="border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md w-full" v-model="filters.type">
                    <option disabled value="">Select User Type</option>
                    <option value="1">Guest Users</option>
                    <option value="2">Subscribers</option>
                </select>
            </div>
        </div>
        <div class="ms-2 mt-3 flow-root">
            <div class="float-right">
                <ButtonRegular size="sm" color="primary" v-on:click="$emit('filter')">Filter</ButtonRegular>
                <ButtonOutline size="sm" color="primary" v-on:click="$emit('reset')">Reset</ButtonOutline>
            </div>
        </div>
    </div>
</template>
<script>
import ButtonRegular from '@/Components/Button.vue';
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
        },
        type: {
            type: Object,
            required: true
        }
    },
    components:{
        ButtonRegular,
        ButtonOutline
    },
    data(){
        return{
            placeholder: 'Search '+this.type.meta.plural
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
