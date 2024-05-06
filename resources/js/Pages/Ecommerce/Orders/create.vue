<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import Views from './views/index.vue';
import OrderForm from './form.vue';
import { ref } from 'vue';

const props = defineProps({
    data: {
        type: Object,
        required: true,
    },
    edit: {
        type: Boolean,
        default: false
    },
    order: {
        type: Object,
        default: {}
    }
});

const breadcrumbItems = ref([
  { name: 'Home', path: '/' },
  { name: 'Orders', path: '/ecommerce/orders' },
  { name: props.edit ? 'Update Order' : 'Create Order', active : 'active' },
  // Add more breadcrumb items if needed
]);
</script>
<template>
    <Head title="Orders" />
    <AdminLayout :breadcrumb-items="breadcrumbItems">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight" v-if="edit">Update Order</h2>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight" v-else>Create Order</h2>
        </template>
        <div class="py-3">
            <div class="sm:px-6 lg:px-8">
                <OrderForm :data="data" :edit="edit" :order="order.data" />
            </div>
        </div>
    </AdminLayout>
</template>
