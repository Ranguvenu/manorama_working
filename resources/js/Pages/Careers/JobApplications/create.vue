<script setup>
import WebsiteLayout from "@/Layouts/WebsiteLayout.vue";
// import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from "@inertiajs/vue3";
import Form from "./form.vue";
import { ref } from "vue"; // Import ref from 'vue'
import ButtonOutline from "@/Components/ButtonOutline.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
let show = false;
const props = defineProps({
    can_edit: {
        type: Boolean,
        required: true
    },
    job: {
        type: Object,
        required: true
    },
    application: {
        type: Object,
        required: false
    },
    submitted:{
        type: Boolean,
        default: false
    }
});
const breadcrumbItems = ref([
    { name: "Home", path: "/" },
    { name: "Careers", path: "/careers" },
    {
        name: "Job Applications",
        path: "/careers/jobapplications",
        active: "active",
    },
    // Add more breadcrumb items if needed
]);

const open = () => {
    show = true;
};

const scrollto = () => {
    // var scrollElement = document.getElementById("jobapplicationform");
    // scrollElement.scrollIntoView({behavior: "smooth"});
    var element = document.getElementById('jobapplicationform');
    var headerOffset = 90;
    var elementPosition = element.getBoundingClientRect().top;
    var offsetPosition = element.offsetTop - headerOffset;

    window.scrollTo({
         top: offsetPosition,
         behavior: "smooth"
    });
}

</script>
<template>
    <Head title="Dashboard" />
    <WebsiteLayout :breadcrumb-items="breadcrumbItems">
        <template>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Job Applications
            </h2>
        </template>
        <div>
            <div class="bg_gray_to_pink">
                <div class="md:max-w-screen-2xl md:mx-auto md:px-16 px-4 py-8 mb-8">
                    <ul class="flex nav_list flex-wrap mb-4">
                        <li class="flex items-center mr-2 nav_listitem">
                            <a href="#" class="text-sm">Home</a>
                        </li>
                        <li class="flex items-center mr-2 nav_listitem">
                            <a href="#" class="text-sm">Career</a>
                        </li>
                        <li class="flex items-center mr-2 nav_listitem">
                            <a href="#" class="text-sm active">{{ $props.job.title }}</a>
                        </li>
                    </ul>
                    <div class="flex flex-wrap flex-col">
                        <div class="text-gray-600 text-sm">Position</div>
                        <div class="text-zinc-800 text-3xl font-semibold">
                            {{ $props.job.title }}:
                            {{ $props.job.subject }}
                        </div>
                        <div class="flex flex-wrap items-center mt-2" v-if="$props.job.tags && $props.job.tags.length">
                            <div class="flex items-center pr-6" v-for="(tag, index) in $props.job.tags">
                                <div class="w-[5px] h-[5px] bg-zinc-400 rounded-full mr-2" v-if="tag"></div>
                                <div class="text-gray-800 text-base">{{ tag }}</div>
                            </div>
                        </div>
                        <div class="mt-3" v-if="!submitted">
                            <PrimaryButton @click="scrollto">Apply Now</PrimaryButton>
                        </div>
                    </div>
                </div>
            </div>
            <div class="md:max-w-screen-2xl mx-auto md:px-16 px-4 py-8 mb-8">
                <div class="mt-2">
                    <div>
                        <div class="ck-content" v-html="$props.job.description"></div>
                    </div>
                </div>
                <div id="jobapplicationform" v-if="$page.props && $page.props.auth && $page.props.auth.user">
                    <Form :job="job" :can_edit="can_edit" :application="application" :submitted="submitted"/>
                </div>
                <div v-else>
                    <div class="bg-rose-200 text-rose-800 p-2 border border-rose-300 rounded text-center">Please login/register to view the assignments and apply to the position</div>
                </div>
            </div>
        </div>
    </WebsiteLayout>
</template>
