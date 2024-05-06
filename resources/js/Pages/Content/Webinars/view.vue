<script setup>
import { Head } from '@inertiajs/vue3';
import WebinarLayout from '@/Layouts/WebinarLayout.vue';
import WebsiteLayout from '@/Layouts/WebsiteLayout.vue';
import { VideoPlayer } from '@videojs-player/vue'
import 'video.js/dist/video-js.css'
const props = defineProps({
    webinar: {
        type: Object,
        required: true
    },
    recents: {
        type: Object,
        required: false
    }
});
const webinar = props.webinar.data;

const breadcrumps = [
    {
        title: 'Home',
        url: '/'
    },
    {
        title: 'Webinar',
        url: '/'
    },
    {
        title: webinar.title,
        url: ''
    }
];
</script>
<template>
    <Head title="StudyMaterial" />
    <WebsiteLayout>
        <WebinarLayout :breadcrumps="breadcrumps" :banner="webinar.thumbnail" :recents="recents.data">
            <template #header>
                <div class="text-black text-4xl font-semibold mb-6 sm:w-full">{{ webinar.title }}</div>
            </template>
            <template #content>
                <div class="ck-content" v-html="webinar.description"></div>
                <div class="text-black text-[23px] font-semibold mb-4 mt-8">Watch this recorded webinar</div>
                <div class="flex justify-between flex-wrap">
                    <div class="flex flex-col md:pr-6 w-full md:w-3/4">
                        <div class="webinar_video_wrap w-full">
                            <iframe width="100%" height="450" :src="webinar.recording_url"></iframe>
                        </div>
                    </div>
                    <div class="flex flex-col flex-shrink-0 md:pl-6 w-full md:w-1/4">
                        <div class="text-black text-xl font-semibold mb-6">Webinar Details</div>

                        <div class="mb-4"><div class="text-gray-600 text-base mb-1">Date</div>
                        <div class="text-black text-base font-medium">{{ webinar.date }}</div></div>

                        <div class="mb-4"><div class="text-gray-600 text-base mb-1">Time</div>
                        <div class="text-black text-base font-medium">{{ webinar.time }} IST</div></div>

                        <div class="mb-4"><div class="text-gray-600 text-base mb-1">Cost</div>
                        <div class="text-black text-base font-medium">Absolute Free</div></div>

                        <div class="mt-8 mb-6"><div class="text-black text-xl font-semibold mb-3">About the presenter</div>
                        <div class="text-black text-base leading-relaxed" v-html="webinar.about"></div></div>
                    </div>
                </div>
            </template>

        </WebinarLayout>
    </WebsiteLayout>
</template>
