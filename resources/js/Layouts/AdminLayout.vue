<script setup>
import { defineProps, ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import Sidebar from '@/Components/Sidebar.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import Breadcrumb from '@/Components/Breadcrumb.vue';

const props = defineProps({
  breadcrumbItems: Array, // Breadcrumb items for the AdminLayout
});

const showingNavigationDropdown = ref(true);
function logout(){
    let payload = {};
    axios.post(route('logout'), payload).then( (response) => {
        if(response && response.data.success){
            window.location.href = response.data.url;
        }
    }).catch(error => {

    });
}
const sidebarItems = ref([
    {
        title: 'Dashboard',
        id: 'dashboard',
        active: true,
    },
    {
        title: 'Users' ,
        id: 'users',
        capabilities: ['view-role', 'view-staff', 'view-subscribers'],
        sublinks: [
          { title: 'Manage Roles', url: '/users/roles', capabilities: ['view-role'] },
          { title: 'Internal Staff', url: '/users/staff/', capabilities: ['view-staff'] },
          { title: 'Manage Registration', url: '/users/subscribers', capabilities: ['view-subscribers'] },
        ],
        open: false
    },
    {
        title: 'Lead Management',
        id: 'leadmanagement',
        capabilities: ['view-all-leads', 'view-assigned-leads', 'view-lead-sources', 'view-newsletter-subscriptions', 'view-contact-requests'],
        sublinks: [
          { title: 'Callback request', url: '/leads/callback/', capabilities: ['view-all-leads', 'view-assigned-leads'] },
          { title: 'Marketing Leads', url: '/leads/marketing/', capabilities: ['view-all-leads', 'view-assigned-leads']},
          { title: 'Registered Users', url: '/leads/registered/', capabilities: ['view-all-leads', 'view-assigned-leads']},
          { title: 'Lead Sources', url: '/masterdata/categories/lead_source', capabilities: ['view-lead_source'] },
          { title: 'Guruvandanam Entries', url: '/guruvandanam/index', capabilities: ['view-guruvandanam_entries'] },
          { title: 'Newsletter Subscriptions', url: '/newsletter/', capabilities: ['view-newsletter-subscriptions'] },
          { title: 'Contact Requests', url: '/contact', capabilities: ['view-contact-requests'] },
        ],
        open: false
    },
    {
        title: 'Ecommerce',
        id: 'ecommerce',
        capabilities: ['view-package', 'view-coupons', 'view-orders', 'view-sap-data'],
        sublinks: [
          { title: 'Packages', url: '/ecommerce/package', capabilities: ['view-package'] },
          { title: 'Coupons', url: '/ecommerce/coupons', capabilities: ['view-coupons'] },
          { title: 'Transactions', url: '/ecommerce/orders', capabilities: ['view-orders'] },
          { title: 'SAP Data', url: '/integrations/sap', capabilities: ['view-sap-data'] },
          { title: 'Package Enrollments', url: '/ecommerce/enrollments', capabilities: ['view-enrollments'] },
        ],
        open: false
    },
    {
        title: 'Website',
        id: 'website',
        capabilities: ['view-website-pages'],
        sublinks: [
          { title: 'Pages', url: '/website/pages', capabilities: ['view-website-pages'] }
        ],
        open: false
    },
    {
        title: 'Content',
        id: 'content',
        capabilities: ['view-resource_type', 'view-downloadable-resource', 'view-webinar', 'view-studymaterial', 'view-webinar_category'],
        sublinks: [
          { title: 'Downloadable Resources', url: '/content/resources', capabilities: ['view-downloadable-resource'] },
          { title: 'Webinars', url: '/content/webinars', capabilities: ['view-webinar'] },
          { title: 'Study Materials', url: '/content/studymaterial', capabilities: ['view-studymaterial'] },
          { title: 'Resources Types', url: '/masterdata/categories/resource_type', capabilities: ['view-resource_type'] },
          { title: 'Webinar Categories', url: '/masterdata/categories/webinar_category', capabilities: ['view-webinar_category'] },
          { title: 'Video Categories', url: '/masterdata/categories/video_category', capabilities: ['view-video_category'] },
          { title: 'Video List', url: '/content/videolist', capabilities: ['view-videolist'] },
        ],
        open: false
    },
    {
        title: 'Site Settings',
        id: 'sitesettings',
        url: '/settings',
        capabilities: ['view-settings'],
    },
    {
        title: 'Articles',
        id: 'articles',
        capabilities: ['view-blog-author', 'view-article', 'view-article_category'],
        sublinks: [
          { title: 'Articles', url: '/blog/article', capabilities: ['view-article'] },
          { title: 'Article Categories', url: '/masterdata/categories/article_category', capabilities: ['view-article_category'] }
        ],
        open: false
    },
    {
        title: 'Current Affairs',
        id: 'current-affairs',
        capabilities: ['view-current-affair', 'view-current-affair_category'],
        sublinks: [
          { title: 'Current Affairs', url: '/blog/current-affair', capabilities: ['view-current-affair'] },
          { title: 'Current Affair Categories', url: '/masterdata/categories/current-affair_category', capabilities: ['view-current-affair_category'] }
        ],
        open: false
    },
    {
        title: 'Notifications',
        id: 'notifications',
        capabilities: ['view-sms_template', 'view-email_template', 'view-sms_log', 'view-email_log'],
        sublinks: [
          { title: 'SMS Templates', url: '/notifications/template/sms', capabilities: ['view-sms_template'] },
          { title: 'Email Templates', url: '/notifications/template/email', capabilities: ['view-email_template'] },
          { title: 'SMS Logs', url: '/notifications/logs/sms', capabilities: ['view-sms_log'] },
          { title: 'Email Logs', url: '/notifications/logs/email', capabilities: ['view-email_log'] },
          { title: 'Template Settings', url: '/notifications/settings', capabilities: ['view-current-affair', 'view-current-affair_category'] }
        ],
        open: false
    },
    {
        title: 'Career',
        id: 'career',
        capabilities: ['view-job-postings', 'view-job_category'],
        sublinks: [
          { title: 'Job Portal', url: '/careers/jobs', capabilities: ['view-job-postings']},
          { title: 'Job Categories', url: '/masterdata/categories/job_category', capabilities: ['view-job_category']},
          { title: 'Career Master', url: '#' },
        ],
        open: false
    },
    {
        title: 'Master Data',
        id: 'masterdata',
        capabilities: ['view-settings', 'view-hierarchy', 'view-blog-author', 'view-field-agent', 'view-college', 'view-universities', 'view-school', 'view-faq', 'view-faq_category', 'view-question_source', 'view-user_category', 'view-testimonials', 'view-countrycode', 'view-cloned-course'],
        sublinks: [
          { title: 'Hierarchy', url: '/masterdata/hierarchy/',  capabilities: ['view-hierarchy'] },
          { title: 'Field agent', url: '/masterdata/agents/', capabilities: ['view-field-agent'] },
          { title: 'Colleges', url: '/masterdata/colleges/', capabilities: ['view-college'] },
          { title: 'Universities', url: '/masterdata/universities/', capabilities: ['view-universities'] },
          { title: 'Schools', url: '/masterdata/schools/', capabilities: ['view-school'] },
          { title: 'Faqs', url: '/masterdata/faq', capabilities: ['view-faq'] },
          { title: 'Faq Categories', url: '/masterdata/categories/faq_category', capabilities: ['view-faq_category'] },
          { title: 'Question Sources', url: '/masterdata/categories/question_source', capabilities: ['view-question_source'] },
          { title: 'User Categories', url: '/masterdata/categories/user_category', capabilities: ['view-user_category']  },
          { title: 'Testimonials', url: '/masterdata/testimonials', capabilities: ['view-testimonials'] },
          { title: 'Country Code', url: '/masterdata/countrycode', capabilities: ['view-countrycode'] },
          { title: 'Master Courses', url: '/masterdata/courses', capabilities: ['view-mastercourses'] },
          { title: 'Cloned Courses', url: '/masterdata/cloned_courses', capabilities: ['view-cloned-course'] },
          { title: 'Authors', url: '/blog/author', capabilities: ['view-blog-author'] },

        ],
        open: false
    },
    {
        title: 'Logs',
        id: 'logs',
        sublinks: [
          { title: 'SMS', url: '#' },
          { title: 'Email', url: '#' },
          { title: 'SMS Template', url: '/notifications/template/sms' },
          { title: 'Email Template', url: '/notifications/template/email' }
        ],
        open: false
    },
]);
</script>

<template>
    <div id="page-wrapper" class="bg-body">
        <div class="min-h-screen">
            <nav class="fixed w-full navbar bg-primary text-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <!--class = "max-w-7xl" removed -->
                <div class="mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <a href="/home"><ApplicationLogo class="block h-9 w-auto fill-current text-gray-800"/></a>
                            </div>
                            <div :class="{ sidebartoggleropen: showingNavigationDropdown, sidebartogglerclose: !showingNavigationDropdown }" class="-mr-2 flex items-center sidebartoggler">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center text-white justify-center p-2 rounded-md focus:outline-none transition duration-150 ease-in-out"
                            >
                                <svg class="h-5 w-4" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                            <!-- Navigation Links -->
                            <!--<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    Dashboard
                                </NavLink>
                            </div>-->
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <a :href="route('integrations.sso.login')" class="h-8 px-4 m-2 me-5 border-2 border-white bg-transparent text-white inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-black/50 focus:bg-primary-600 focus:shadow-black/50 focus:outline-none focus:ring-0 active:bg-default-700 dark:hover:focus:ring-offset-2 transition ease-in-out duration-150" target="__blank">LMS Dashboard</a>
                            <div class="relative inline-block notifications">
                                <img src="/images/notification.png" alt="Notifications">
                                <span class="notifications_count text-primary bg-white w-4 h-4 rounded-full absolute -mt-1 -mr-1 text-xs flex items-center justify-center">5</span>
                            </div>
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative user_menu">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 text-white focus:outline-none transition ease-in-out duration-150"
                                            >
                                                {{ $page.props.auth.user.name }}
                                                <img v-if="$page.props.auth.user.avatar?.url" :src="$page.props.auth.user.avatar?.url" alt="Profile Picture of {{ $page.props.auth.user.name }}" class="border-primary border-2 rounded-full ml-2">
                                                <img v-else src="/images/profile/profile.png" alt="Profile Picture of {{ $page.props.auth.user.name }}" class="border-primary border-2 rounded-full ml-2">
                                                <svg
                                                    class="h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.index')"> Profile </DropdownLink>
                                        <DropdownLink as="button" v-on:click="logout">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:text-gray-500 transition duration-150 ease-in-out"
                            >
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="sm:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>
            <div
                    :class="{ sidebar_opened: showingNavigationDropdown, sidebar_closed: !showingNavigationDropdown }" id="sidebarwrap"
                >
                <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="userinfo_wrap flex-wrap flex-row justify-center w-100 pt-8 pb-6">
                    <div  class="flex justify-center">
                        <img v-if="$page.props.auth.user.avatar?.url" :src="$page.props.auth.user.avatar?.url" alt="Profile Picture of {{ $page.props.auth.user.name }}" class="border-primary border-2 rounded-full">
                        <img v-else src="/images/profile/profile.png" alt="Profile Picture of {{ $page.props.auth.user.name }}" class="border-primary border-2 rounded-full">
                    </div>
                    <div class="flex justify-center">{{ $page.props.auth.user.name }}</div>
                </div>
                <Sidebar :sidebar-content="sidebarItems" />
            </div>
            <div id="page" :class="{ page_sidebar_opened: showingNavigationDropdown, page_sidebar_closed: !showingNavigationDropdown }">
                <!-- Page Heading -->
                <div class="flex justify-between items-center flex-wrap" id="page-header">
                    <header v-if="$slots.header">
                        <div class="mx-auto pt-4 pb-2 px-4 sm:px-6 lg:px-8">
                            <slot name="header" />
                        </div>
                    </header>
                      <div class="flex justify-end px-4">
                        <Breadcrumb :items="breadcrumbItems" />
                      </div>
                </div>
                <!-- Page Content -->
                <main>
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>
