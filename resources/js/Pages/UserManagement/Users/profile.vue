<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import ProfileView from './views/profileview.vue';

const props = defindProps({
    staff: {
        type: Object,
    }
});


</script>

<template>
    <Head title="Staff Profile" />
    <AdminLayout>
        <ProfileView />
    </AdminLayout>    
</template>