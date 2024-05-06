<script setup>
import WebsiteLayout from '@/Layouts/WebsiteLayout.vue';
import { Head } from '@inertiajs/vue3';
import SuccessResponse from './success.vue';
const props = defineProps({
    data: {
        type: Object,
        required: true
    }
});
</script>
<template>
    <Head title="Checkout" />
    <WebsiteLayout>
        <SuccessResponse :response="data.data"/>
    </WebsiteLayout>
</template>
