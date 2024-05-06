<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import Views from './views/index.vue';
import { ref } from 'vue';
const props = defineProps({
    type: {
        type: Object,
        required: true
    }
});

</script>

<template>
    <Head title="Migrations" />
    <AdminLayout :breadcrumb-items="breadcrumbItems">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Migrations</h2>
        </template>

        <div class="py-3">
            <div class="sm:px-6 lg:px-8">
                <Views :type="props.type"/>
            </div>
        </div>
    </AdminLayout>
</template>
