<template>
        <div>
            <table class="min-w-full text-left text-sm font-light">
                <thead class="border-b font-medium dark:border-neutral-500">
                    <tr>
                        <th>Title</th>
                        <th>Published on</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b dark:border-neutral-500" v-for="(data, index) in results" :key="data.id" v-if="results && results.length">
                        <td>{{ data.title }}</td>
                        <td>{{ data.published_on }}</td>
                        <td>{{ data.status }}</td>
                        <td>
                            <ActionsDropdown align="right">
                                <template v-slot:content>
                                    <div class="divide-y border-lightestgrey">
                                        <a :href="route('webinar.show', {webinar: data.slug})" v-if="$has_capability('view-webinar')" class="block py-1 px-4 actions_icon" target="__blank">View</a>
                                        <a href="javascript:void(0)" v-if="$has_capability('edit-webinar')" v-on:click="$emit('edit', data.id)" class="block py-1 px-4 actions_icon">Edit</a>
                                        <a href="javascript:void(0)" v-if="$has_capability('delete-webinar')" v-on:click="$emit('delete', data)" class="block py-1 px-4 actions_icon">Delete</a>
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
        props: {
            results: {
                type: Array,
                required: true,
            },
            meta: {
                type: Object,
                required: true
            }
        },
        components: {
            ActionsDropdown,
        },
        data() {
            return {};
        },
        methods: {
            
        },
        mounted() {},
    };
</script>
