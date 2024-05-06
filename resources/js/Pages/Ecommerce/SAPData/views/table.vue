<template>
    <div>
        <table class="min-w-full text-left text-sm font-light">
            <thead class = "border-b font-medium dark:border-neutral-500">
                <tr>
                    <th>Order ID</th>
                    <th>SAP Type</th>
                    <th>Last Subumitted at</th>
                    <th>Attempts</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(data, index) in results" v-if="results && results.length" :key="index">
                    <td>{{ data.order_key }}</td>
                    <td>{{ data.sap_type_name }}</td>
                    <td>{{ data.last_submited_at }}</td>
                    <td>{{ data.attempts }}</td>
                    <td>{{ data.status }}</td>
                    <td v-if="$has_capability('edit-sap-data')">
                        <ActionsDropdown align="right">
                            <template #content>
                                <div class="divide-y border-lightestgrey">
                                    <a href="javascript:void(0)" v-if="$has_capability('edit-sap-data')"
                                        v-on:click="$emit('edit', data.id)" class="block py-1 px-4 actions_icon">Details</a>
                                </div>
                            </template>
                        </ActionsDropdown>
                    </td>
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
        components: {
            ActionsDropdown    
        },
        props:{
            results: {
                type: Array,
                required: true,
            },
            meta: {
                type: Object,
                required: true,
            }
        },
        data() {
            return {
    
            }
        },
        methods: {
    
        },
        mounted() {
    
        }
    };
</script>
