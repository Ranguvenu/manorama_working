<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import Details from './details/index.vue';
import { ref } from 'vue'; // Import ref from 'vue'

const breadcrumbItems = ref([
  { name: 'Home', path: '/' },
  { name: 'Profile', active : 'active' },
  // Add more breadcrumb items if needed
]);

const props = defineProps({
    data:{
        type: Object,
        required: true
    }
});

</script>
<template>
    <Head title="User Profile" />
        <AdminLayout :breadcrumb-items="breadcrumbItems">
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Details</h2>
            </template>  
            <div class="py-6">           
                <div class="sm:px-6 lg:px-8">               
                    <Details :data="props.data.data"/>
                </div>
            </div>  
        </AdminLayout>
</template>
