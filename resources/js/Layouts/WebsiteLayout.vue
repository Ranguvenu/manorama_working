<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import { MagnifyingGlassIcon } from "@heroicons/vue/24/solid";
import ViewCoursesButton from '@/Modules/ViewCourses/index.vue';
import axios from 'axios';
import TextInput from '@/Components/TextInput.vue';

const showingNavigationDropdown = ref(false);
defineProps({
    page: {
        type: Object,
        required: false
    }
});
const search = ref('');
function logout() {
    let payload = {};
    axios.post(route('logout'), payload).then((response) => {
        if (response && response.data.success) {
            window.location.href = response.data.url;
        }
    }).catch(error => {

    });
}

function searchWebsite(){
    window.location.href = route('search', {search: search.value});
}
</script>

<template>
    <div>
        <div class="page-designer-toolbar sm:fixed top-0 w-full z-50 bg-rose-600"
            v-if="page && $page.props.auth.user && ($has_capability('design-website-pages') || $has_capability('create-website-pages') || $has_capability('edit-website-pages'))">
            <div class="flex flex-wrap items-center justify-between ">
                <div class="flex">
                    <div class="text-white text-sm bg-gray-600 px-8 py-2 items-start">{{ page.title }}</div>
                </div>
                <div>
                    <a v-if="$has_capability('create-website-pages')"
                        class="text-white text-sm hover:bg-secondary cursor-pointer p-2 item-center mx-2"
                        :href="route('website.pages.create')">New Page</a>
                    <a v-if="$has_capability('edit-website-pages')"
                        class="text-white text-sm hover:bg-secondary cursor-pointer p-2"
                        :href="route('website.pages.edit', { page: page.id })">Edit Page</a>
                    <a v-if="$has_capability('design-website-pages')"
                        class="text-white text-sm hover:bg-secondary cursor-pointer p-2"
                        :href="route('website.pages.components.index', { page: page.id })">Page Builder</a>
                </div>
                <div class="me-5">
                    <a class="text-white text-sm hover:bg-secondary cursor-pointer p-2 items-start"
                        :href="route('dashboard')">Dashboard</a>
                </div>
            </div>
        </div>
        <header :class="{'top-[2.2rem]':(page && $page.props.auth.user && ($has_capability('design-website-pages') || $has_capability('create-website-pages') || $has_capability('edit-website-pages')))}" class="bg-white shadow md:px-16 custom_md:px-4 px-4 siteheader w-full sm:fixed top-0 z-[1024]">

            <div class="md:max-w-screen-2xl md:mx-auto custom_md:max-w-full">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="pr-4 md:block hidden"><a href="/home"><img src="/images/header/logo.png" alt="Logo" /></a></div>
                        <div class="pr-4 md:hidden block"><img src="/images/header/logo_s.png" alt="Logo" /></div>
                        <form @submit.prevent="searchWebsite" class="hidden md:inline-block">
                            <div class="relative ">
                                <TextInput type="text" placeholder="What do you want to learn" class="w-full min-w-[250px] mt-1 pr-8 text-sm" v-model="search" autofocus/>
                                <MagnifyingGlassIcon class="mx-auto w-[19px] h-[19px] absolute top-[14px] right-3 text-gray-400" aria-hidden="true" />
                            </div>

                        </form>
                    </div>
                    <div class="items-center flex">
                        <a
                            class="icon ml-2 flex-shrink-0 flex md:hidden items-center justify-center w-9 h-9 bg-pink-200 rounded-full"><span
                                class="search_icon">
                                <MagnifyingGlassIcon class="mx-auto h-6 w-6 text-primary" aria-hidden="true" />
                            </span></a>
                        <ViewCoursesButton />
                        <span class="pl-17 hidden md:block"><img src="/images/homepage/whatsapp_rounded.png"
                                alt="Logo" /></span>
                        <span class="pl-17 hidden md:block"><img src="/images/homepage/call_rouned.png" alt="Logo" /></span>
                        <div class="pl-17 flex-col items-start md:inline-flex custom_md:hidden hidden">
                            <div class="text-center text-stone-300 text-xs font-medium">Talk to our experts</div>
                            <div class="text-center text-black text-sm font-medium">1800-120-456-456</div>
                        </div>
                        <div class="lg:pl-17 pl-[10px]" v-if="!$page.props.auth.user"><a :href="route('login')"
                                class="px-6 font-medium m-0 bg-rose-600 rounded-[5px] text-white py-1" size="sm"
                                color="primary">Login</a></div>
                        <div v-if="$page.props.auth.user" class="ml-3 relative user_menu">
                            <Dropdown align="right" width="48" :triggerEvent="'hover'">
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-1 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-primary focus:outline-none transition ease-in-out duration-150">

                                            <img v-if="$page.props.auth.user.avatar?.url"
                                                :src="$page.props.auth.user.avatar?.url"
                                                alt="Profile Picture of {{ $page.props.auth.user.name }}"
                                                class="rounded-full ml-2 w-12 h-12">
                                            <img v-else src="/images/profile/profile.png"
                                                alt="Profile Picture of {{ $page.props.auth.user.name }}"
                                                class="rounded-full ml-2 w-12 h-12">
                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <a class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                                        :href="route('integrations.sso.login')" method="get" as="button"> Dashboard </a>
                                    <a class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                                        href="javascript:void(0)" as="button" v-on:click="logout"> Log Out </a>
                                </template>
                            </Dropdown>
                        </div>
                        <!-- <a v-if="$page.props.auth.user" :href="route('integrations.sso.login')" class="bg-red-50 rounded border border-rose-500 px-[10px] py-[7px] text-center text-rose-500 text-sm font-medium ms-2" v-on:click="show = true">Dashboard </a> -->
                    </div>
                </div>
            </div>
            <!-- mobile version whatsapp and call icons -->
            <div class="fixed left-1 flex md:hidden flex-col gap-5 bottom-20 px-2 z-50">
                <a class=" "><img src="/images/homepage/whatsapp_rounded_primary.svg" alt="Logo" /></a>
                <a class=" "><img src="/images/homepage/call_rounded_primary.svg" alt="Logo" /></a>
            </div>
        </header>
        <div class="content-wrap md:mt-[90px] relative" :class="{'md:!mt-[120px] ':(page && $page.props.auth.user && ($has_capability('design-website-pages') || $has_capability('create-website-pages') || $has_capability('edit-website-pages')))}">
            <main>
                <slot />
            </main>
        </div>
        <footer>
            <div class="bg-gray-100">
                <div class="max-w-screen-2xl mx-auto w-full md:px-16 px-4 py-6">
                    <div class="flex flex-wrap">
                        <div class="flex flex-col w-full md:w-1/4 sm:w-1/2" v-for="(links, index) in $page.props.footerlinks" :key="index">
                            <div class="text-lg font-medium my-4 relative">{{ links.name }}<span class="absolute border-b-4 border-primary w-8 h-1 top-[36px] hidden left-0"></span></div>
                            <ul class=" text-sm text-gray-700 py-2" v-if="links.children && links.children.length">
                                <li class="mb-3" v-for="(link, index) in links.children">
                                    <a :href="link.link" class=" hover:underline">{{ link.name }}</a>
                                </li>
                            </ul>
                        </div>

                    </div>

                </div>
                <div class="border-t flex flex-wrap max-w-screen-2xl mx-auto w-full md:px-16 px-4 py-6">
                    <div class="flex flex-col w-full md:w-1/4 sm:w-1/2 ">
                        <div class="font-medium my-4 relative">Get App</div>
                        <div class="w-36">
                            <img src="/images/download_on_the_app_store_badge.svg" class="w-full" alt="">
                            <img src="/images/google_play_store_badge.svg" class="w-full mt-3" alt="">
                        </div>

                    </div>
                    <div class="flex flex-col w-full md:w-1/4 sm:w-1/2 ">
                        <div class=" font-medium my-4 relative">Contact Us<span class="absolute border-b-4 border-primary w-8 h-1 top-[36px] hidden left-0"></span></div>
                        <ul class="text-sm font-medium py-2">
                            <li class="mb-3">
                                <a href="#" class="text-gray-700 hover:underline">{{ $page.props.theme_settings.contactemail}}</a>
                            </li>
                            <li class="mb-3">
                                <a href="#" class="text-gray-700 hover:underline">{{ $page.props.theme_settings.contactphone }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="flex flex-wrap flex-col w-full md:w-1/3">
                        <div class=" text-base my-4 font-medium w-full mb-6">Follow us on</div>
                        <div class="flex flex-wrap justify-start">
                            <div class="mr-3"><a :href = $page.props.theme_settings.facebook ><img  src="/images/socialicon/facebook.png" alt="Facebook" /></a></div>
                            <div class="mr-3"><a v-bind:href = "$page.props.theme_settings.instagram"><img  src="/images/socialicon/instagram.png" alt="Instagram" /></a></div>
                            <div class="mr-3"><a v-bind:href = "$page.props.theme_settings.youtube"><img  src="/images/socialicon/youtube.png" alt="YouTube" /></a></div>
                            <div class="mr-3"><a v-bind:href = "$page.props.theme_settings.linkedin"><img  src="/images/socialicon/linkedin.png" alt="LinkedIn" /></a></div>
                            <div class="mr-3"><a v-bind:href = "$page.props.theme_settings.pininterest"><img  src="/images/socialicon/pinterest.png" alt="Pinterest" /></a></div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap justify-between items-center py-8  mx-auto w-full md:px-16 px-4">
                    <div class="text-sm md:w-1/2 w-full mb-5 md:mb-0 "><span>{{ $page.props.theme_settings.secondaryfooter_content }} | </span><span class="underline">Sitemap</span></div>
                    <div class="flex gap-6 md:justify-end md:w-1/2 w-full">
                        <a href="#" class="text-sm hover:underline">Privacy Policy</a>
                        <a href="#" class="text-sm hover:underline">Terms and Conditions</a>
                    </div>
                </div>
            </div>

        </footer>
    </div>
</template>
