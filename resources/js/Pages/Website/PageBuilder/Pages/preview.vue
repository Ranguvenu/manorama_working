<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import ViewPage from '../PageDesigner/view.vue';
import WebsiteLayout from '@/Layouts/WebsiteLayout.vue';
defineProps({
    page: {
        type: Object,
    }
});
</script>

<template>
    <Head>
        <title>{{ page.title }}</title>
    </Head> 
    <WebsiteLayout :page="page">
        <div>
            <ViewPage :page="page.id"/>
        </div>
    </WebsiteLayout>
</template>
