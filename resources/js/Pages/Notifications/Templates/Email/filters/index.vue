<template>
    <div class="filters-wrapper p-6 mt-2 relative rounded-md" v-if="show">
        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12 py-3">
            <div class="sm:col-span-4">
                <MultiSelect 
                    v-model="filters.type" 
                    placeholder="Notification Types"
                    returns="id" 
                    :options="notificationtypes"
                    label="title" 
                    :multiple="false"
                    />
            </div>
            <div class="sm:col-span-4">
                <select class="border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md w-full" v-model="filters.status">
                    <option value="-1">Select Status</option>
                    <option value="0">InActive</option>
                    <option value="1">Active</option>
                </select>
            </div>
        </div>
        <div class="filter-submit absolute">
            <Button size="sm" color="primary" v-on:click="$emit('filter')">Filter</Button>
            <ButtonOutline size="sm" color="primary" v-on:click="$emit('reset')">Reset</ButtonOutline>
        </div>
    </div>
</template>
<script>
    import Button from '@/Components/Button.vue';
    import ButtonOutline from '@/Components/ButtonOutline.vue';
    import MultiSelect from "@/Components/MultiSelect.vue";
export default{
    props: {
        filters: {
            type: Object,
            required: true
        },
        notificationtypes: {
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
        ButtonOutline,
        MultiSelect,
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
