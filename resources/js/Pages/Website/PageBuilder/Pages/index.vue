<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import Views from "./views/index.vue";
import { ref } from 'vue';

const breadcrumbItems = ref([
  { name: 'Home', path: '/' },
  { name: 'Pages', active : 'active' },
  // Add more breadcrumb items if needed
]);

const props = defineProps({
    data: {
        type: Object,
        required: false
    },
});

</script>

<template>
    <Head title="Pages"/>
    <AdminLayout :breadcrumb-items="breadcrumbItems">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pages</h2>
        </template>
        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <Views :data="data"/>
            </div>
        </div>
    </AdminLayout>
</template>
