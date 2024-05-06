<template>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(data, index) in results" v-if="results && results.length">
                    <td>
                        <div>{{ data.title }}</div>
                    </td>
                    <td>{{ data.author }}</td>
                    <td>
                        <div class="text-sm">{{ data.status_name }}</div>
                        <div class="text-sm">{{ data.date }}</div>
                    </td>
                    <td>
                        <ActionsDropdown align="right">
                            <template #content>
                                <div class="divide-y border-lightestgrey">
                                    <a v-if="$has_capability('design-website-pages')"
                                        :href="route('website.pages.components.index', [data.id])"
                                        class="block py-1 px-4 actions_icon">Design</a>
                                    <a :href="route('website.pages.components.show', [data.id])"
                                        class="block py-1 px-4 actions_icon">Preview</a>
                                    <a v-if="$has_capability('edit-website-pages')"
                                        :href="route('website.pages.edit', [data.id])"
                                        class="block py-1 px-4 actions_icon">Edit</a>
                                    <a v-if="data.page_type == 'page'" :href="route('frontend.index', [data.slug])"
                                        class="block py-1 px-4 actions_icon" target="__blank">View</a>
                                    <a v-if="data.page_type == 'package'"
                                        :href="route('frontend.package', { page: data.slug, type: data.page_type })"
                                        class="block py-1 px-4 actions_icon" target="__blank">View</a>
                                    <a v-if="$has_capability('delete-website-pages')" href="javascript:void(0)"
                                        v-on:click="$emit('destroy', data.id)"
                                        class="block py-1 px-4 actions_icon">Delete</a>
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
