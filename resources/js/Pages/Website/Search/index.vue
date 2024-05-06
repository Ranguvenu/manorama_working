<script setup>
import WebsiteLayout from '@/Layouts/WebsiteLayout.vue';
import { Head } from '@inertiajs/vue3';
import SearchResults from './results.vue';
const props = defineProps({
    results: {
        type: Object,
        required: true
    },
    term: {
        type: String,
        required: false
    }
});
</script>

<template>
    <Head>
        <title>Search</title>
        <meta name="description" content="Your page description">
        <meta head-key="description" name="description" content="This is the default description" />
        <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    </Head> 
    <WebsiteLayout>
        <div class="container m-auto py-4">
            <SearchResults :results="results" :term="term"/>
        </div>
    </WebsiteLayout>
</template>
