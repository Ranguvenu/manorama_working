<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import Views from './views/index.vue';
import { ref } from 'vue';

const props  = defineProps({
    countrycode: {
        type: Object
    }
});

const breadcrumbItems = ref([
  { name: 'Home', path: '/' },
  { name: 'Country Codes', active : 'active' },
  // Add more breadcrumb items if needed
]);
</script>
<style>
</style>
<template>
    <Head title="Country Codes" />
        <AdminLayout :breadcrumb-items="breadcrumbItems">
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Country Codes</h2>
            </template>      
            <div class="py-6">   
                <div class="sm:px-6 lg:px-8">          
                    <Views :countrycode="props.countrycode"/>
                </div>
            </div>  
        </AdminLayout>
</template>
