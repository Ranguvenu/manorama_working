<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import Views from './views/index.vue';
import { ref } from 'vue';

const props = defineProps({
    taxonomy: {
        type: Object
    }
});
const breadcrumbItems = ref([
    { name: 'Home', path: '/' },
    { name: props.taxonomy.plural, active: 'active' },
    // Add more breadcrumb items if needed
]);
</script>
<style></style>
<template>
    <Head :title="props.taxonomy.plural" />
    <AdminLayout :breadcrumb-items="breadcrumbItems">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ props.taxonomy.plural }}</h2>
        </template>
        <div class="py-6">
            <div class="sm:px-6 lg:px-8">
                <Views :taxonomy="props.taxonomy" />
            </div>
        </div>
    </AdminLayout>
</template>
