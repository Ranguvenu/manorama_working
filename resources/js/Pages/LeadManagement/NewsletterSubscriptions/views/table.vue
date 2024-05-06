<template>
    <div>
        <table class="min-w-full text-left text-sm font-light">
            <thead class="border-b font-medium dark:border-neutral-500">
                <tr>
                    <th>IP Address</th>
                    <th>Subscriber email</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b dark:border-neutral-500" v-for="(data, index) in results" v-if="results && results.length">
                    <td>{{ data.ip_address }}</td>
                    <td>{{ data.email }}</td>
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
                required: true,
            },
            meta: {
                type: Object,
                rquired: true
            }
        },
        components: {
            ActionsDropdown
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
