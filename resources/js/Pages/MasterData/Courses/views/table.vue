<template>
    <div>
        <table class="min-w-full text-left text-sm font-light">
            <thead class="border-b font-medium dark:border-neutral-500">
                <tr>
                    <th>Goal</th>
                    <th>Board</th>
                    <th>Class</th>
                    <th>Course Title</th>
                    <th>Code</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(data, index) in results" v-if="results && results.length" :keys="index">
                    <td>{{ data.goal }}</td>
                    <td>{{ data.board }}</td>
                    <td>{{ data.class }}</td>
                    <td>{{ data.title }}</td>
                    <td>{{ data.code }}</td>
                    <td>
                        <a :href="get_course_url(data.mdl_id)" class="text text-primary cursor-pointer">View Course</a>
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
import ActionsDropdown from "@/Components/ActionsDropdown.vue";
export default {
    props: {
        results: {
            type: Array,
            required: true,
        },
        meta: {
            type: Object,
            required: true,
        },
    },
    components: {
        ActionsDropdown,
    },
    data() {
        return {};
    },
    methods: {
        get_course_url(course_id) {
            return route('integrations.sso.login', {course: course_id});
        },
    },
    mounted() { },
};
</script>
