<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import Views from './views/index.vue';
import { ref } from 'vue'; // Import ref from 'vue'

const props = defineProps({
    category: {
        type: Object,
        required: true
    },
    sources: {
        type: Object,
        required: true

    },
    packages: {
        type: Object,
        required: true
    },
    agents: {
        type: Object,
        required: true
    }
});

const marketingbreadcrumbItems = ref([
  { name: 'Home', path: '/dashboard' },
  { name: props.category.meta.plural, path: '/leads/'+props.category.slug, active : 'active' },
  // Add more breadcrumb items if needed
]);

</script>
<template>
    <Head :title="props.category.meta.plural" />
    <AdminLayout :breadcrumb-items="marketingbreadcrumbItems">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ props.category.meta.plural }}</h2>
        </template> 
        <div class="py-6">    
            <div class="sm:px-6 lg:px-8">            
                <Views :category="props.category" :sources = "props.sources" :packages = "props.packages" :agents = "props.agents"/>
            </div>
        </div>  
    </AdminLayout>
</template>
