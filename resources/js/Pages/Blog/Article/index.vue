<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import Views from './views/index.vue';
import { ref } from 'vue'; // Import ref from 'vue'

const props = defineProps({
    data: {
        type: Object,
        required: false
    },
    type: {
        type: Object,
        required: false
    }
});

const breadcrumbItems = ref([
    { name: 'Home', path: '/' },
    { name: props.type.meta.plural, active : 'active' },
    // Add more breadcrumb items if needed
]);

</script>
<template>
    <Head :title="props.type.meta.plural" />
        <AdminLayout :breadcrumb-items="breadcrumbItems">
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ type.meta.plural }}</h2>
            </template>          
            <div class="py-3 sm:px-6 lg:px-8">               
                <Views :data="data" :type="type"/>
            </div>
        </AdminLayout>
</template>
