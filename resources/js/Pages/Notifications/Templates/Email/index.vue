<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import Views from './views/index.vue';
import { ref } from 'vue'; // Import ref from 'vue'

const breadcrumbItems = ref([
  { name: 'Home', path: '/' },
  { name: 'Email Templates', active : 'active' },
  // Add more breadcrumb items if needed
]);

defineProps({
    notificationtypes: {
        type: Object,
        required: true,
    },
});

</script>
<template>
    <Head title="Email Templates" />
        <AdminLayout :breadcrumb-items="breadcrumbItems">
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Email Templates</h2>
            </template>  
            <div class="py-3">           
                <div class="mx-auto sm:px-6 lg:px-8">               
                    <Views :notificationtypes="notificationtypes"/>
                </div>
            </div>  
        </AdminLayout>
</template>
