<script setup>
import { Head } from '@inertiajs/vue3';
import StudyMaterialLayout from '@/Layouts/StudyMaterialLayout.vue';
import WebsiteLayout from '@/Layouts/WebsiteLayout.vue';

const props = defineProps({
    material: {
        type: Object,
        required: true
    }
});
const material = props.material.data;

const breadcrumps = [
    {
        title: 'Home',
        url: '/'
    },
    {
        title: 'Study Material',
        url: '/'
    },
    {
        title: material.title,
        url: ''
    }
];
</script>
<template>
    <Head title="StudyMaterial" />
    <WebsiteLayout>
        <StudyMaterialLayout :breadcrumps="breadcrumps" :banner="material.banner_image">
            <template #header>
                <div class="text-black text-4xl font-semibold mb-6 sm:w-full">{{ material.title }}</div>
            </template>
            <template #author v-if="material.author">
                <div class="text-white text-base font-medium">
                    <p>By {{ material.author.name }}</p>
                    <p>Updated on: {{ material.updated_on }}</p>
                </div>
            </template>
            <template #content>
                <div class="ck-content" v-html="material.description"></div>
            </template>
            <template #about_author v-if="material.author">
                <div class="w-[75px] h-[75px] mb-2"><img class="inline-block w-20 h-20 rounded-full" :src="material.author_image" /></div>
                <div class="break-all text-black text-sm font-medium mb-4">{{ material.author.name }}</div>
                <div class="break-all text-gray-600 text-xs" v-html="material.author.bio"></div>
            </template>
            <div class="py-3 sm:px-6 lg:px-8"></div>    
        </StudyMaterialLayout>
    </WebsiteLayout>
</template>
