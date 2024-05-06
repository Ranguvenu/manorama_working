<template>
    <div>
        <table class="min-w-full text-left text-sm font-light">
            <thead class="border-b font-medium dark:border-neutral-500">
                <tr>
                    <th>Subject</th>
                    <th>Batch Name</th>
                    <th>Batch Code</th>
                    <th>Enrollment Start Date</th>
                    <th>Enrollment End Date</th>
                    <th>Batch Start Date</th>
                    <th>Batch End Date</th>
                    <th>Duration</th>
                    <th>Student Limit</th>
                    <th>Provider</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <template v-if="batches && batches.length">
                    <tr class="border-b dark:border-neutral-500" v-for="(batch, index) in batches" :key="index">
                        <td>{{ batch.course }}</td>
                        <td>{{ batch.name }}</td>
                        <td>{{ batch.code }}</td>
                        <td>{{ batch.enrollment_start_date }}</td>
                        <td>{{ batch.enrollment_end_date }}</td>
                        <td>{{ batch.batch_start_date }}</td>
                        <td>{{ batch.batch_end_date }}</td>
                        <td>{{ batch.batch_duration }}</td>
                        <td>
                            <a href="javascript:void(0)" class="text-primary"
                                v-on:click="$emit('view-enrollments', batch.id)">{{ batch.enrollments }} / {{
                                    batch.batch_size }}</a>
                        </td>
                        <td>{{ batch.batch_provider }}</td>
                        <td>
                            <span v-if="batch.is_active" class="bg-green-100 text-green-800 px-3 rounded-xl">Active</span>
                            <span v-else class="bg-red-100 text-red-800 px-3 rounded-xl">In Active</span>
                        </td>
                        <td>
                            <span>
                                <ActionsDropdown align="right">
                                    <template v-slot:content>
                                        <div class="divide-y border-lightestgrey">
                                            <a :href="get_course_url(batch.mdl_course_id)" class="block py-1 px-4 actions_icon">View Course</a>
                                            <a href="javascript:void(0)" v-on:click="$emit('edit', batch.id)" v-if="$has_capability('edit-batch')" class="block py-1 px-4 actions_icon">Edit</a>
                                            <a href="javascript:void(0)" v-on:click="$emit('delete', batch.id)" v-if="$has_capability('delete-batch')" class="block py-1 px-4 actions_icon">Delete</a>
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
                            <div class="text-center text-gray-800 p-2">Batches are not configured for the package</div>
                        </td>
                    </tr>
                </template>
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
    props: {
        batches: {
            type: Object,
        }
    },
    data() {
        return {

        }
    },
    methods: {
        get_course_url(course_id) {
            return route('integrations.sso.login', { course: course_id });
        }
    },
    mounted() {

    }
}
</script>
