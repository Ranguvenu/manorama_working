<template>
    <div class="flex justify-between items-center w-100">
        <div>
            <div class="cursor-pointer flex" v-on:click="$emit('show-filters')">Filters
                <AdjustmentsHorizontalIcon class="ms-2 h-6 w-6 text-gray-1000" />
            </div>
        </div>
        <div class="flex items-center w-100">
            <input type="text"
                class="py-2 h-8 text-sm border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md shadow-sm"
                placeholder="Search Leads" v-model="filters.search" @input="filter('search', $event.target.value)" />
            <CreateLead :current="current" :category="category" @close="$emit('close')" @refresh="$emit('refresh')"/>
            <BulkUpload :sample="sample" :headers="headers" :title="category.meta.upload"
                v-if="category.meta.canupload && $has_capability('import-leads')"
                component="App\Imports\LeadManagement\LeadsImport" />
            <SummaryReport :category="category"/>
        </div>
    </div>
</template>
<script>
import { AdjustmentsHorizontalIcon } from '@heroicons/vue/24/solid';
import Filters from "../filters/index.vue";
import CreateLead from '../create.vue';
import BulkUpload from '@/Modules/BulkUpload/index.vue';
import SummaryReport from './summary-report.vue';

export default {
    components: {
        Filters,
        AdjustmentsHorizontalIcon,
        CreateLead,
        BulkUpload,
        SummaryReport
    },
    props: {
        current: {
            type: Number,
            required: false,
            default: 0
        },
        category: {
            type: Object,
            required: true
        },
        filters: {
            type: Object,
            required: true
        }
    },
    emits: ["show-filters", "filter"],
    data() {
        return {
            sample: '/samplesheets/leads-import_sample.csv',
            headers: {
                name: 'Name',
                country_code: 'Country Code',
                phone_number: 'Phonenumber',
                email: 'Email',
                source: 'Source',
                tags: 'Tags',
                agent_email: 'Agent Email'
            }
        }
    },
    methods: {
        filter(key, value, emit = true) {
            emit ? this.$emit("filter") : false;
        },
    },
    mounted() {

    }
}
</script>
