<template>
    <div>
        <table class="min-w-full text-left text-sm font-light">
            <thead class="border-b font-medium dark:border-neutral-500">
                <tr>
                    <th>Coupon Code</th>
                    <th>Packages</th>
                    <th>Discount Type</th>
                    <th>Value</th>
                    <th>Valid From</th>
                    <th>Valid To</th>
                    <th>Availed</th>
                    <th v-if="$has_capability('edit-coupon') || $has_capability('delete-coupon')">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b dark:border-neutral-500 " v-for="(data, index) in results"
                    v-if="results && results.length">
                    <td>{{ data.code }}</td>
                    <td>{{ data.package }}</td>
                    <td>{{ data.discount_type }}</td>
                    <td>{{ data.discount_value }}</td>
                    <td>{{ data.valid_from }}</td>
                    <td>{{ data.valid_to }}</td>
                    <td>
                        <a href="javascript:void(0)" class="text-primary" v-on:click="$emit('view-claims', data.id)">{{ data.availed }}/{{ data.number_of_codes }}</a>
                    </td>
                    <td v-if="$has_capability('edit-coupon') || $has_capability('delete-coupon')">
                        <ActionsDropdown align="right">
                            <template #content>
                                <div class="divide-y border-lightestgrey">
                                    <a href="javascript:void(0)" v-if="$has_capability('edit-coupon')"
                                        v-on:click="$emit('edit', data.id)" class="block py-1 px-4 actions_icon">Edit</a>
                                    <a href="javascript:void(0)" v-if="$has_capability('delete-coupon')"
                                        v-on:click="$emit('delete', data)" class="block py-1 px-4 actions_icon">Delete</a>
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
import Button from "@/Components/Button.vue";
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
        ActionsDropdown,   
        Button,      
    },
    data() {
        return {
            data: [],
            show: false

        }
    },
    methods: {

    },
    mounted() {

    }
}
</script>
