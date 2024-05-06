<template>
    <div>
        <table class="min-w-full text-left text-sm font-light">
            <thead class="border-b font-medium dark:border-neutral-500">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b dark:border-neutral-500 " v-for="(data, index) in results"
                    v-if="results && results.length">
                    <td>{{ data.user.firstname }} {{ data.user.lastname }}</td>
                    <td>{{ data.user.email }}</td>
                    <td>{{ data.user.phone_number }}</td>
                    <td>{{ data.status_name }}</td>
                    <td>
                        <ActionsDropdown align="right">
                            <template v-slot:content>
                                <div class="divide-y border-lightestgrey">
                                    <a href='javascript:void(0)' class="block py-1 px-4 actions_icon" @click="$emit('view-application', data.id)">View details</a>
                                    <a href='javascript:void(0)' class="block py-1 px-4 actions_icon" @click="$emit('update-status', data.id, 3)" v-if="data.status != 3">Shortlist</a>
                                    <a href='javascript:void(0)' class="block py-1 px-4 actions_icon" @click="$emit('update-status', data.id, 4)" v-if="data.status != 4">Reject</a>
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
import ButtonRegular from "@/Components/Button.vue";
export default {
    props: {
        results: {
            type: Array,
            required: true
        }
    },
    components: {
        ActionsDropdown,
        ButtonRegular
    },
    data() {
        return {
            data : [],
            assignment : [],
            qualification: ''
        }
    },
    methods: {
    
    },
    mounted() {

    }
}
</script>
