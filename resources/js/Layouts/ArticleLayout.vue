<template>
    <div class="content-wrap">
        <div class="max-w-screen-2xl mx-auto article_header px-4 md:px-16 py-8" v-bind:style="{ backgroundImage: 'url(' + bannerimage + ')' }">
            <div class="flex flex-col">
                <ul class="flex nav_list flex-wrap mb-4">
                    <li class="flex items-center mr-2 nav_listitem" v-for="(breadcrump, index) in breadcrumps">
                        <a href="#" class="text-sm !text-white">{{ breadcrump.title }}</a>
                    </li>
                </ul>
                <slot name="header" v-if="$slots.header"></slot>
                <slot name="author" v-if="$slots.author"></slot>
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
