<script setup>
    import AdminLayout from '@/Layouts/AdminLayout.vue';
    import { Head } from '@inertiajs/vue3';

    import RegistrationCounter from '@/Pages/Dashboards/Widgets/RegistrationCounter.vue';
    import BatchesCount from '@/Pages/Dashboards/Widgets/BatchesCount.vue';
    import PackagesCount from '@/Pages/Dashboards/Widgets/PackagesCount.vue';
    import EnrolmentsCount from '@/Pages/Dashboards/Widgets/EnrolmentsCount.vue';
    import ArticleCount from '@/Pages/Dashboards/Widgets/ArticleCount.vue';
    import CurrentAffairsCount from '@/Pages/Dashboards/Widgets/CurrentAffairsCount.vue';
    import ResourcesCounter from '@/Pages/Dashboards/Widgets/ResourcesCounter.vue';
    import OrdersCount from '@/Pages/Dashboards/Widgets/OrdersCounter.vue';
    // data blocks
    import LearningDataWidget from '@/Pages/Dashboards/Widgets/LearningDataWidget.vue';
    import FinancialDataWidget from '@/Pages/Dashboards/Widgets/FinancialDataWidget.vue';
    import WebsiteContentDataWidget from '@/Pages/Dashboards/Widgets/WebsiteContentDataWidget.vue';
    import OrdersDataWidget from '@/Pages/Dashboards/Widgets/OrdersDataWidget.vue';
    import UpcomingClassroomsWidget from '@/Pages/Dashboards/Widgets/UpcomingClassroomsWidget.vue';

</script>

<template>
    <Head title="Dashboard" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>
        <div class="overflow-hidden sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 mb-4">
                <RegistrationCounter></RegistrationCounter>
                <BatchesCount></BatchesCount>
                <EnrolmentsCount></EnrolmentsCount>
                <PackagesCount></PackagesCount>
                <ArticleCount></ArticleCount>
                <CurrentAffairsCount></CurrentAffairsCount>
                <ResourcesCounter></ResourcesCounter>
                <OrdersCount></OrdersCount>
            </div>
            <!-- Data Block Container-->
            <!-- <div class="grid grid-cols-1 md:grid-cols-3 gap-3 px-2 mb-3">
                <LearningDataWidget></LearningDataWidget>
                <FinancialDataWidget></FinancialDataWidget>
                <WebsiteContentDataWidget></WebsiteContentDataWidget>
            </div> -->
            <div class="grid grid-cols-1 md:grid-cols-1 gap-3 px-2 mb-3">
                <OrdersDataWidget></OrdersDataWidget>
                <!-- <UpcomingClassroomsWidget></UpcomingClassroomsWidget> -->
            </div>
        </div>
    </AdminLayout>
</template>
