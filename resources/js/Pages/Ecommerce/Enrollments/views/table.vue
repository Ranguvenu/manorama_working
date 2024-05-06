<template>
    <div>
        <table class="min-w-full text-left text-sm font-light">
            <thead class="border-b font-medium dark:border-neutral-500">
                <tr>
                    <th>Order Key</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Package Courses</th>
                    <th>Enrollment Type</th>
                    <th>Enrolled Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(data, index) in results" v-if="results && results.length" :keys="index">
                    <td>
                        <a class="text-primary" :href="route('ecommerce.orders.edit', {order: data.order_id})" v-if="data.order_id">{{ data.order_key }}</a>
                    </td>
                    <td>{{ data.fullname }}</td>
                    <td>{{ data.email }}</td>
                    <td>{{ data.packagename }} <br>
                        {{ data.courses }} </td>
                    <td>{{ data.enrolltype }}</td>
                    <td>{{ data.enrolleddate }}</td>
                    <td>{{ data.enrolment_status }}</td>
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
import ActionsDropdown from "@/Components/ActionsDropdown.vue";
export default {
    props: {
        results: {
            type: Array,
            required: true,
        },
        meta: {
            type: Object,
            required: true,
        },
    },
    components: {
        ActionsDropdown,
    },
    data() {
        return {};
    },
    methods: {

    },
    mounted() { },
};
</script>
