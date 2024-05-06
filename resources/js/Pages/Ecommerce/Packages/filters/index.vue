<template>
    <div class="filters-wrapper p-6 mt-2 relative rounded-md" v-if="show">
        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12 py-3">
            <div class="sm:col-span-4">
                <DateRangePicker v-model="filters.date"/>           
            </div>
            <div class="sm:col-span-4">
                <MultiSelect v-model="filters.goal" placeholder="Select Goal" returns="id" :options="data.goals" label="title" :multiple="false"/>
            </div>
            <div class="sm:col-span-4">
                <MultiSelect v-model="filters.board" placeholder="Select Board" returns="id" :options="data.boards" label="title" :multiple="false"/>
            </div>
            <div class="sm:col-span-4">
                <MultiSelect v-model="filters.classes" placeholder="Select Class" returns="id" :options="data.classes" label="title" :multiple="false"/>
            </div>
            <div class="sm:col-span-4">
                <MultiSelect v-model="filters.subject" placeholder="Select Subject" returns="id" :options="data.subjects" label="title" :multiple="false"/>
            </div>
            <div class="sm:col-span-4">
                <select class="border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md w-full" v-model="filters.payment">
                    <option disabled value="">Select Payment Type</option>
                    <option v-for="(paymenttype, index) in data.payment_types" :key="index"  :value="index">{{ paymenttype }}</option>
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
import 'vue-datepicker-ui/lib/vuedatepickerui.css';
import ButtonRegular from '@/Components/Button.vue';
import ButtonOutline from '@/Components/ButtonOutline.vue';
import MultiSelect from '@/Components/MultiSelect.vue';
import VueDatepickerUi from 'vue-datepicker-ui';
import DateRangePicker from '@/Components/DateRangePicker/index.vue';
export default{
    props: {
        filters: {
            type: Object,
            required: true
        },
        results: {
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
        },
        data: {
            type: Object,
            required: true
        }
    },
    components:{
        ButtonRegular,
        MultiSelect,
        ButtonOutline,
        DateRangePicker
    },
    data(){
        return{
            // placeholder: 'Search '+this.type.meta.plural
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
