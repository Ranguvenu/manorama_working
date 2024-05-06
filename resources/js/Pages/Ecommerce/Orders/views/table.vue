<template>
    <div>
        <table class="min-w-full text-left text-sm font-light">
            <thead class="border-b font-medium dark:border-neutral-500">
                <tr>
                    <th>Order Key</th>
                    <th>Order Date</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Package</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(data, index) in results" v-if="results && results.length" :keys="index">
                    <td>
                        <a class="text-primary" :href="route('ecommerce.orders.edit', {order: data.id})">{{ data.orderid }}</a>
                    </td>
                    <td>{{ data.created_at }}</td>
                    <td>{{ data.email }}</td>
                    <td>{{ data.mobilenumber }} </td>
                   <td>{{ data.packagename }} <br>
                        {{ data.courses }}
                    </td>
                    <td>₹ {{ data.amount }} /-</td>
                    <td><span class="text-black  rounded-xl px-3 me-2 py-1 text-xs "
                        :class="{'bg-green-300':data.status_name=='Completed',
                        'bg-amber-300':data.status_name=='Free Trial',
                        'bg-red-300':(data.status_name=='Cancelled' || data.status_name=='Payment Failed'),
                        'bg-gray-300':data.status_name=='Not Applicable',
                        'bg-orange-300':data.status_name=='Processing',
                        'bg-amber-400':data.status_name=='Pending Payment'}">{{ data.status_name }}</span></td>
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
import ActionsDropdown from '@/Components/ActionsDropdown.vue';
export default {
    props: {
        results: {
            type: Array,
            required: true
        },
        meta: {
            type: Object,
            required: true
        }
    },
    components: {
        ActionsDropdown
    },
    data() {
        return {
        }
    },
    methods: {
    },
    mounted() {
    }
}
</script>
