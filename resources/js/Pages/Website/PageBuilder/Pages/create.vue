<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import CreatePageForm from "./form.vue";
import { ref } from 'vue';

const props = defineProps({
    page: {
        type: Object,
        required: false
    },
    edit: {
        type: Number,
        required: false
    },
    resource: {
        type: Object
    },
    options:{
        type: Object,
        required: true
    }
});

const breadcrumbItems = ref([
  { name: 'Home', path: '/' },
  { name: 'Pages', path: '/website/pages' },
  { name: props.edit ? 'Edit Page' : 'Add Page', active : 'active' },
  // Add more breadcrumb items if needed
]);

</script>

<template>
    <Head title="Pages"/>
    <AdminLayout :breadcrumb-items="breadcrumbItems">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"><span v-if="edit">Edit</span><span v-else>Add</span> Page</h2>
        </template>
        <div class="">
            <div class="sm:px-6 lg:px-8" v-if="$has_capability('create-website-pages')">
                <CreatePageForm :page="page" :edit="edit" :resource="resource" :options="options"/>
            </div>
            <div v-else>
               <h2> You don't have capability to create the page</h2>
            </div>
        </div>
    </AdminLayout>
</template>
