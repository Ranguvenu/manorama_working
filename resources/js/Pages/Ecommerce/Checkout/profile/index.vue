<script setup>
import WebsiteLayout from '@/Layouts/WebsiteLayout.vue';
import { Head } from '@inertiajs/vue3';
import ProfileForm from './form/index.vue';
const props = defineProps({
    profile: {
        type: Object,
        required: true
    }
});
</script>
<template>
    <Head title="Checkout" />
    <WebsiteLayout>
        <ProfileForm :profile="profile"/>
    </WebsiteLayout>
</template>
