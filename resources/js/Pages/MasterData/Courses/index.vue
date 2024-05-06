<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import Views from './views/index.vue';
import { ref } from 'vue';
const breadcrumbItems = ref([
    { name: 'Home', path: '/' },
    { name: 'Courses', active: 'active' },
    // Add more breadcrumb items if needed
]);

const open = () => {
    show = true;
};
defineProps({
    data: {
        type: Object,
        required: true,
    },
});
</script>
<template>
    <Head title="Master Courses" />
    <AdminLayout :breadcrumb-items="breadcrumbItems">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Master Courses</h2>
        </template>
        <div class="py-3">
            <div class="sm:px-6 lg:px-8">
                <Views :data="data" />
            </div>
        </div>
    </AdminLayout>
</template>
