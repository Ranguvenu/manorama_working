<template>
    <div class="flex justify-between items-center w-100">
        <div>
            <div class="cursor-pointer flex" v-on:click="$emit('show-filters')">Filters
                <AdjustmentsHorizontalIcon class="ms-2 h-6 w-6 text-gray-1000" />
            </div>
        </div>
        <div class="flex items-center w-100">
            <input type="text" class="py-2 h-8 text-sm border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md shadow-sm" placeholder="Search Package" v-model="filters.search" @input="filter('search', $event.target.value)" />
            <a v-if="$has_capability('create-package')" :href="route('ecommerce.packages.create', {slug: 'package'})" class="h-8 px-4 m-2 bg-primary text-white inline-flex items-center px-4 py-2 border border-transparent rounded-md font-medium text-xs tracking-widest">Create Package</a>
            <SummaryReport/>
        </div>
    </div>
</template>
<script>
    import { AdjustmentsHorizontalIcon } from '@heroicons/vue/24/solid';
    import Filters from "../filters/index.vue";
    import SummaryReport from './summary-report.vue';

    export default{
        components:{
            Filters,
            AdjustmentsHorizontalIcon,
            SummaryReport,
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
                current: this.current,
                sample: '/samplesheets/users-import_sample.csv',
                headers: {
                    name: 'Name',
                    email: 'Email',
                    firstname: 'Firstname',
                    lastname: 'Lastname',
                    password: 'Password',
                    country_code: 'Country Code',
                    phone_number: 'Phonenumber'
                }
            }
        },
        methods: {
            filter(key, value, emit = true) {
                emit ? this.$emit("filter") : false;
            },
        },
        watch: {
            current(val) {
                this.current = val;
            }
        },
        mounted(){
            
        }
    }
</script>
