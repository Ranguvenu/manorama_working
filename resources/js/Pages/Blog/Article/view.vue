<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import ArticleLayout from '@/Layouts/ArticleLayout.vue';
import WebsiteLayout from '@/Layouts/WebsiteLayout.vue';

const props = defineProps({
    article: {
        type: Object,
        required: true
    },
    type: {
        type: Object,
        required: true
    }
});
const article = props.article.data;

const breadcrumps = [
    {
        title: 'Home',
        url: '/'
    },
    {
        title: article.categories[0] ? article.categories[0] : 'All',
        url: ''
    },
    {
        title: article.title,
        url: ''
    }
];
</script>
<template>
    <Head :title="type.name" />
    <WebsiteLayout>
        <ArticleLayout :breadcrumps="breadcrumps" :banner="article.banner_image">
            <template #header>
                <div class="text-zinc-100 text-sm font-normal mb-3"><span class="me-2" v-for="(category, index) in article.categories">{{ category }}</span></div>
                <div class="break-all text-white text-4xl font-semibold mb-6 md:w-1/2 sm:w-full">{{ article.title }}</div>
            </template>
            <template #author v-if="article.author">
                <div class="text-white text-base font-medium">
                    <p>By {{ article.author.name }}</p>
                    <p>Published on: {{ article.published_on }}</p>
                </div>
            </template>
            <template #content>
                <div class="ck-content" v-html="article.description"></div>
            </template>
            <template #about_author v-if="article.author">
                <div class="w-[75px] h-[75px] mb-2"><img class="inline-block w-20 h-20 rounded-full" :src="article.author_image" /></div>
                <div class="break-all text-black text-sm font-medium mb-4">{{ article.author.name }}</div>
                <div class="break-all text-gray-600 text-xs" v-html="article.author.bio"></div>
            </template>
            <div class="py-3 sm:px-6 lg:px-8"></div>    
        </ArticleLayout>
    </WebsiteLayout>
</template>
