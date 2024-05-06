<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import PackageForms from './forms/index.vue';
import { ref } from 'vue';

const props = defineProps({
    data: {
        type: Object,
        required: true,
    },
    package: {
        type: Object,
        required: true,   
    },
    edit: {
        type: Boolean,
        required: false
    },
    active: {
        type: String,
        required: true,
        default: 'package'
    }
});

const breadcrumbItems = ref([
  { name: 'Home', path: '/' },
  { name: 'Packages', path: '/ecommerce/package' },
  { name: props.edit ? 'Update Package' : 'Create Package', active : 'active' },
  // Add more breadcrumb items if needed
]);
</script>
<template>
    <Head title="Create Package"/>
    <AdminLayout :breadcrumb-items="breadcrumbItems">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight" v-if="edit">Update Package</h2>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight" v-else>Create Package</h2>
        </template>
        <div class="py-3">
            <PackageForms :data="data" :package="package.data" :active="active" :edit="edit"/>
        </div>
    </AdminLayout>
</template>

