<template>
    <div class="bg_gray_to_pink">
        <div class="max-w-screen-2xl mx-auto px-4 md:px-16 py-8">
            <ul class="flex nav_list flex-wrap lg:flex-nowrap md:mb-6">
                <li class="flex items-center mr-2 nav_listitem" v-for="(breadcrump, index) in breadcrumps">
                    <a href="#" class="text-sm">{{ breadcrump.title }}</a>
                </li>
            </ul>
            <div class="flex flex-wrap justify-between">
                <div class="flex flex-col w-full md:w-1/2 mt-6">
                    <div class="text-neutral-900 text-sm mb-2">Higher Education</div>
                    <slot name="header" v-if="$slots.header"></slot>
                </div>
                <div class="relative w-full md:w-[300px] h-[280px] flex-shrink-0">
                    <img class="rounded-md object-cover h-[250px] w-full md:w-[300px]" :src="props.banner" />
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-screen-2xl mx-auto w-full px-4 md:px-16 py-6">
        <slot name="content" v-if="$slots.content"></slot>
    </div>
    <div class="max-w-screen-2xl mx-auto w-full mx-auto px-4 md:px-16 mt-6 py-6">
        <div class="text-black text-[25px] font-semibold mb-6">Recent Webinars</div>
        <div class="flex flex-row flex-wrap -mx-4">
            <div class="md:w-1/4 w-1/2 px-4 mb-4" v-for="(item, index) in recents" :key="index">
                <div class="flex flex-col shadow-[0_4px_14px_rgba(0,0,0,0.04)] rounded-lg">
                    <div class="relative">
                        <img class="rounded-tl-lg rounded-tr-lg w-full h-[200px] object-cover" :src="item.thumbnail" :alt="item.title" />
                        <div class="absolute bg-blue-800 rounded-tr-xl rounded-br-xl bottom-[12px] px-3 pb-1 pt-[2px]">
                            <span class="text-white text-xs">{{ item.badge }}</span>
                        </div>
                    </div>
                    <div class="bg-white rounded-bl-lg rounded-br-lg border-l border-r border-b border-zinc-100 px-4 py-6">
                        <div class="text-zinc-800 text-base font-semibold mb-3 min-h-[40px] leading-tight">
                            <a :title="item.title" :href="route('webinar.show', {webinar: item.slug})">{{ item.title }}</a>
                        </div>
                        <div class="text-gray-600 text-xs"> {{ item.created_on }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ChevronRightIcon } from "@heroicons/vue/24/solid";
const props = defineProps({
    breadcrumps: {
        type: Array,
        required: true
    },
    banner: {
        type: String,
        required: true
    },
    recents: {
        type: Array,
        required: false
    }
});
const bannerimage = "'" + props.banner + "'"


</script>
