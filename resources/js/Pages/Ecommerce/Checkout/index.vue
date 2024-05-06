<script setup>
import WebsiteLayout from '@/Layouts/WebsiteLayout.vue';
import { Head } from '@inertiajs/vue3';
import CheckoutForm from './form/index.vue';
</script>
<template>
    <Head title="Checkout" />
    <WebsiteLayout>
        <CheckoutForm/>
    </WebsiteLayout>
</template>
