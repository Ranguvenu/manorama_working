<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import Views from './views/index.vue';
import { ref } from 'vue';

const open = () => {
    show = true;
};
defineProps({
    data: {
        type: Object,
        required: true,
    },
});

const breadcrumbItems = ref([
    { name: 'Home', path: '/'},
    { name: 'Enrollments', active: 'active'}
]);

</script>
<template>
    <Head title="Package Enrollments" />
    <AdminLayout :breadcrumb-items="breadcrumbItems">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> Package Enrollments</h2>
        </template>
        <div class="py-3">
            <div class="sm:px-6 lg:px-8">
                <Views :data="data" />
            </div>
        </div>
    </AdminLayout>
</template>
