<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import Views from './views/index.vue';
import { ref } from 'vue'; // Import ref from 'vue'
let show = false;

const breadcrumbItems = ref([
  { name: 'Home', path: '/' },
  { name: 'Study Materials', active : 'active' },
  // Add more breadcrumb items if needed
]);

const open = () => {
    show = true;
};
</script>
<template>
    <Head title="Study Materials" />
        <AdminLayout :breadcrumb-items="breadcrumbItems">
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Study Materials</h2>
            </template>  
            <div class="py-3">           
                <div class="sm:px-6 lg:px-8">               
                    <Views/>
                </div>
            </div>  
        </AdminLayout>
</template>
