<template>
    <div>
        <table class="min-w-full text-left text-sm font-light table-auto">
            <thead class="border-b font-medium dark:border-neutral-500">
                <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th  v-if="$has_capability('edit-'+taxonomy.slug) || $has_capability('delete-'+taxonomy.slug)">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    class="border-b dark:border-neutral-500"
                    v-for="(data, index) in results"
                    v-if="results.length"
                >
                    <td class="">{{ data.name }}</td>
                    <td class="">{{ data.code }}</td>
                    <td class="" v-if="$has_capability('edit-'+taxonomy.slug) || $has_capability('delete-'+taxonomy.slug)">
                        <ActionsDropdown align="right">
                          <template v-slot:content>
                            <div class="divide-y border-lightestgrey">
                                <a href="javascript:void(0)" v-on:click="$emit('edit', data.id)" v-if="$has_capability('edit-'+taxonomy.slug)" class="block py-1 px-4 actions_icon">Edit</a>
                                <a href="javascript:void(0)" v-on:click="$emit('delete', data)" v-if="$has_capability('delete-'+taxonomy.slug)" class="block py-1 px-4 actions_icon">Delete</a>
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
        taxonomy:{
            type: Object,
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

        };
    },
    methods: {
        
    },
    mounted() {

    },
};
</script>
