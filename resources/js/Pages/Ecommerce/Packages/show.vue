<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import ViewPackage from './view/index.vue';
const props = defineProps({
    data: {
        type: Object,
        required: true,
    }
});
</script>
<template>
    <Head title="Packages" />
    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ props.data.data.title }}</h2>
        </template>

        <div class="py-3">
            <div class="sm:px-6 lg:px-8">
                <ViewPackage :data="data.data"/>
            </div>
        </div>
    </AdminLayout>
</template>

