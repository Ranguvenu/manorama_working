<template>
    <div>
        <table class="min-w-full text-left text-sm font-light">
            <thead class="border-b font-medium dark:border-neutral-500">
                <tr>
                    <th> School Name</th>
                    <th>Code</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Address</th>
                    <th> Contact Info</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b dark:border-neutral-500 " v-for="(data, index) in results"
                    v-if="results && results.length">
                    <td>{{ data.name }}</td>
                    <td>{{ data.code }}</td>
                    <td>{{ data.location }}</td>
                    <td> {{ data.is_published }}</td>
                    <td>{{ data.address }}</td>
                    <td>{{ data.contact_details }}</td>
                    <td>
                        <ActionsDropdown align="right">
                            <template #content>
                                <div class="divide-y border-lightestgrey">
                                    <a href="javascript:void(0)" v-if="$has_capability('view-school')"
                                        v-on:click="$emit('view', data.id)" class="block py-1 px-4 actions_icon">View</a>
                                    <a href="javascript:void(0)" v-if="$has_capability('edit-school')"
                                        v-on:click="$emit('edit', data.id)" class="block py-1 px-4 actions_icon">Edit</a>
                                    <a href="javascript:void(0)" v-if="$has_capability('delete-school')"
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
