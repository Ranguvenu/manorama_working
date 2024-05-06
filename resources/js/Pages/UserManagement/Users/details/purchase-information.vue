<template>
    <div>
        <table class="min-w-full text-left text-sm font-light">
            <thead class="border-b font-medium dark:border-neutral-500">
                <tr>
                    <th>Order ID</th>
                    <th>Package Name</th>
                    <th>Courses</th>
                    <th>Amount</th>
                    <th>Transaction ID</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b dark:border-neutral-500" v-for="(order, index) in data.orders" v-if="data.orders && data.orders.length">
                    <td>{{ order.order_key }}</td>
                    <td>{{ order.package_name }}</td>
                    <td>{{ order.courses }}</td>
                    <td>&#8377; {{ order.order_amount }}</td>
                    <td>{{ order.transaction_id }}</td>
                    <td>{{ order.status_name }}</td>
                    <td>{{ order.created_at }}</td>
                </tr>
                <tr v-else>
                    <td colspan="14">
                        <div class="text-center">No Data Available</div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    export default {
        props: {
            data: {
                type: Object,
                required: false,
            }
        },
        data() {
            return {};
        },
        methods: {
            
        },
        mounted() {

        },
    };
</script>
