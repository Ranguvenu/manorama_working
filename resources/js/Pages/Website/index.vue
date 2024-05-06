<script setup>
import WebsiteLayout from '@/Layouts/WebsiteLayout.vue';
import { Head } from '@inertiajs/vue3';
import ViewComponents from './PageBuilder/PageDesigner/Components/view.vue';

const props = defineProps({
    elements: {
        type: Array,
        required: true
    },
    page: {
        type: Object,
        required: true
    }
});
</script>

<template>
    <Head>
        <title>{{ page.title }}</title>
        <meta name="description" content="Your page description">
        <meta head-key="description" name="description" content="This is the default description" />
        <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    </Head> 

    <WebsiteLayout :page="page">
        <template v-for="element in elements" :key="element.name">
            <div v-if="element && element.visible">
                <ViewComponents :component="element.component" :configuration="element.configuration"/>
            </div>
        </template>
    </WebsiteLayout>
</template>
