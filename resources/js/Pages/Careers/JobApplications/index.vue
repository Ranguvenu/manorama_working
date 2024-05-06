<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import Views from './views/index.vue';
import { ref } from 'vue'; // Import ref from 'vue'
let show = false;

const props = defineProps({
    data: {
        type: Object,
        required: false
    }
});

const breadcrumbItems = ref([
  { name: 'Home', path: '/' },
  { name: 'Careers', path: route('careers.jobs.index') },
  { name: props.data.title, active : 'active' },
  // Add more breadcrumb items if needed
]);

const open = () => {
    show = true;
};

</script>
<template>
    <Head title="Job Applications" />
        <AdminLayout :breadcrumb-items="breadcrumbItems">
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Job Applications - {{ props.data.title }} : {{ props.data.subject }}</h2>
            </template>  
            <div class="py-6">      
                <div class="sm:px-6 lg:px-8">          
                    <Views :job="data"/>
                </div>
            </div>  
        </AdminLayout>
</template>
