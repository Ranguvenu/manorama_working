<template>
    <div>
        <table class="min-w-full text-left text-sm font-light">
            <thead class="border-b font-medium dark:border-neutral-500">
                <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    class="border-b dark:border-neutral-500"
                    v-for="(data, index) in results"
                    v-if="results.length"
                >
                    <td>{{ data.name }}</td>
                    <td>{{ data.code }}</td>
                    <td>
                        <ActionsDropdown align="right">
                          <template #content>
                            <div class="divide-y border-lightestgrey">
                                <a href="javascript:void(0)" v-if="$has_capability('edit-countrycode')" v-on:click="$emit('edit', data.id)" class="block py-1 px-4 actions_icon">Edit</a>
                                <a href="javascript:void(0)" v-if="$has_capability('delete-countrycode')" v-on:click="$emit('delete', data)" class="block py-1 px-4 actions_icon">Delete</a>
                            </div>
                          </template>
                        </ActionsDropdown>
                    </td>
                </tr>
                <tr v-if="!results.length">
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
        countrycode:{
            type: Object,
            required: true
        }
    },
    components: {
        ActionsDropdown
    },
    data() {
        return {

        };
    },
    methods: {
        
    },
    mounted() {

    },
};
</script>
