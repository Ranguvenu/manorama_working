<template>
    <div>
        <table class="min-w-full text-left text-sm font-light">
            <thead class="border-b font-medium dark:border-neutral-500">
                <tr>
                    <th>Actual Price</th>
                    <th>Offer Price</th>
                    <th>Subject</th>
                    <th>SAP Data</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <template v-if="pricing && pricing.length">
                    <tr class="border-b dark:border-neutral-500" v-for="(price, index) in pricing" :key="index">
                        <td>{{ price.actual_price }}</td>
                        <td>{{ price.selling_price }}</td>
                        <td>{{ price.courses }}</td>
                        <td>{{ price.sap_ism_product_code }}</td>
                        <td>
                            <span>
                                <ActionsDropdown align="right">
                                <template v-slot:content>
                                    <div class="divide-y border-lightestgrey">
                                        <a v-if="$has_capability('edit-pricing')" href="javascript:void(0)" v-on:click="$emit('edit', price.id)" class="block py-1 px-4 actions_icon">Edit</a>
                                        <a v-if="$has_capability('delete-pricing')" href="javascript:void(0)" v-on:click="$emit('delete', price.id)" class="block py-1 px-4 actions_icon">Delete</a>
                                    </div>
                                </template>
                                </ActionsDropdown>
                            </span>
                        </td>
                    </tr>
                </template>
                <template v-else>
                    <tr>
                        <td colspan="14">
                            <div class="text-center text-gray-800 p-2">Pricing is not configured for the package</div>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>
<script>
import ActionsDropdown from '@/Components/ActionsDropdown.vue';

export default{
    components: {
        ActionsDropdown
    },
    props: {
        pricing: {
            type: Array,
            required: true
        }
    },
    data(){
        return{

        }
    },
    methods:{

    },
    mounted(){
    }
}
</script>
