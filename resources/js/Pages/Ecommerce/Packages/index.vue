<template>
    <Head title="Packages" />
    <AdminLayout :breadcrumb-items="breadcrumbItems">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Packages</h2>
        </template>
        <div class="py-3">
            <div class="sm:px-6 lg:px-8">
                <Views :data="data"/>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import Views from './views/index.vue';
import { ref } from 'vue';

defineProps({
    data: {
        type: Object,
        required: true,
    },
});

const breadcrumbItems = ref([
  { name: 'Home', path: '/' },
  { name: 'Packages', active : 'active' },
  // Add more breadcrumb items if needed
]);

</script>
