<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head } from "@inertiajs/vue3";
import Views from "./views/index.vue";
</script>

<template>
    <Head title="Site Settings"/>
    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Site Settings
            </h2>
        </template>
        <div class="py-6">
            <div class="overflow-hidden sm:px-6 lg:px-8">
                <div class="border border-gray-300">
                    <Views/>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
