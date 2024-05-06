<template>
    <div class="flex justify-between items-center w-100">
        <div>
            <div class="cursor-pointer flex" v-on:click="$emit('show-filters')" v-if="type.slug == 'subscribers'">Filters
                <AdjustmentsHorizontalIcon class="ms-2 h-6 w-6 text-gray-1000" />
            </div>
        </div>
        <div class="flex items-center w-100">
            <input type="text" class="py-2 h-8 text-sm border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md shadow-sm" :placeholder="placeholder" v-model="filters.search" @input="filter('search', $event.target.value)" />
            <CreateStaff :type="type" :current="current" @close="$emit('close')" @refresh="$emit('refresh')"/>
            <BulkUpload :sample="sample" :title="type.meta.upload" :headers="headers" v-if="type.meta.canupload && (type.slug == 'subscribers')" component="App\Imports\UserManagement\RegisteredUserImport" @refresh="$emit('refresh')"/>
            <SummaryReport :type="type"/>
        </div>
    </div>
</template>
<script>
    import { AdjustmentsHorizontalIcon } from '@heroicons/vue/24/solid';
    import Filters from "../filters/index.vue";
    import CreateStaff from '../create.vue';
    import BulkUpload from '@/Modules/BulkUpload/index.vue';
    import SummaryReport from './summary-report.vue';
    export default{
        components:{
            Filters,
            AdjustmentsHorizontalIcon,
            CreateStaff,
            BulkUpload,
            SummaryReport
        },
        props:{
            type: {
                type: Object,
                required: true
            },
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
                sample: '/samplesheets/users-import_sample.csv',
                headers: {
                    name: 'Name',
                    email: 'Email',
                    firstname: 'Firstname',
                    lastname: 'Lastname',
                    password: 'Password',
                    country_code: 'Country Code',
                    phone_number: 'Phonenumber'
                },
                placeholder: 'Search '+this.type.meta.plural
            }
        },
        methods:{
            filter(key, value, emit = true) {
                emit ? this.$emit("filter") : false;
            },  
        },
        mounted(){
            
        }
    }
</script>
