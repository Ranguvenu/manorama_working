<template>
    <div class="max-w-screen-2xl mx-auto px-4 md:px-16 py-8 bg_gray_to_pink">
        <ul class="flex nav_list flex-wrap lg:flex-nowrap md:mb-6">
            <li class="flex items-center mr-2 nav_listitem" v-for="(breadcrump, index) in breadcrumps">
                <a href="#" class="text-sm">{{ breadcrump.title }}</a>
            </li>
        </ul>
        <div class="flex justify-between">
            <div class="flex flex-col w-full md:w-1/2 mt-6">
                <div class="text-neutral-900 text-sm mb-2">Higher Education</div>
                <slot name="header" v-if="$slots.header"></slot>
            </div>
            <div class="hidden md:w-1/2 md:block">
                <img class="rounded-md w-full max-w-[500px]" :src="props.banner" />
            </div>
        </div>
    </div>

    <div class="max-w-screen-2xl mx-auto w-full md:px-16 px-4 py-6">
        <div class="flex flex-wrap justify-between">
            <div class="flex flex-col w-full md:pr-4 md:w-3/5 lg:w-3/4">
                <slot name="content" v-if="$slots.content"></slot>
            </div>
            <div class="flex flex-col w-full md:w-2/5 lg:w-1/4 md:pl-4">
                <div class="bg-white rounded-[10px] shadow py-6 px-4 mb-4">
                    <BlogSidebar/>
                </div>
                <div class="flex flex-col bg-white rounded-[10px] shadow mb-4 px-3 py-4" v-if="$slots.about_author">
                    <div class="text-black text-base font-semibold mb-3">About Author</div>
                    <slot name="about_author" v-if="$slots.about_author"></slot>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ChevronRightIcon } from "@heroicons/vue/24/solid";
import BlogSidebar from '@/Modules/BlogSidebar/index.vue';
const props = defineProps({
    breadcrumps: {
        type: Array,
        required: true
    },
    banner: {
        type: String,
        required: true
    }
});
const bannerimage = "'" + props.banner + "'"


</script>
