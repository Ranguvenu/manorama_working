<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import Views from './views/index.vue';
import { ref } from 'vue'; // Import ref from 'vue'


const guruvandanambreadcrumbItems = ref([
  { name: 'Home', path: '/dashboard' },
  { name: 'Guruvandanam', active : 'active' },
  // Add more breadcrumb items if needed
]);

</script>
<template>
   
    <AdminLayout :breadcrumb-items="guruvandanambreadcrumbItems">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Guruvandanam Entries</h2>
        </template> 
        <div class="py-6">    
            <div class="sm:px-6 lg:px-8">            
                <Views/>
            </div>
        </div>  
    </AdminLayout>
</template>
