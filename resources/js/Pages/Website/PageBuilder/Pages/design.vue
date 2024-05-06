<script setup>
import WebsiteLayout from '@/Layouts/WebsiteLayout.vue';
import { Head } from '@inertiajs/vue3';
import PageDesigner from '../PageDesigner/index.vue';
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
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Design Page</h2>
        </template>
        <div>
            <PageDesigner :page="page.id" :data="page"/>
        </div>
    </WebsiteLayout>
</template>
