<template>
    <div class="border border-gray-300 mb-2 bg-white">
        <div class="flow-root bg-zinc-100 px-2" v-on:click="show = !show">
            <div class="float-left font-semibold py-2 text-gray-600">{{ data.course_title }}</div>
            <div class="float-right">
                <ChevronRightIcon class="h-10 w-5 text-gray-1000 font-semibold" aria-hidden="true" v-if="!show"/>
                <ChevronDownIcon class="h-10 w-5 text-gray-1000 font-semibold" aria-hidden="true" v-if="show"/>
            </div>
        </div>
        
        <div class="m-3 " v-if="show">
            <table class="min-w-full text-left text-sm font-light">
                <thead class="border-b font-medium dark:border-neutral-500">
                    <tr>
                        <th>Batch Name</th>
                        <th>Code</th>
                        <th>Date</th>
                        <th>Duration</th>
                        <th>Student Limit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b dark:border-neutral-500 " v-for="(batch, index) in data.batches"
                        v-if="data.batches && data.batches.length">
                        <td>{{ batch.name }}</td>
                        <td>{{ batch.code }}</td>
                        <td>{{ batch.batch_start_date }} - {{ batch.batch_end_date }}</td>
                        <td>{{ batch.batch_duration }}</td>
                        <td>
                            <a href="javascript:void(0)" class="text-primary" v-on:click="$emit('view-enrollments', batch.id)">{{ batch.enrollments }} / {{ batch.batch_size }}</a></td>
                        <td>
                            <a :href="get_course_url(batch.mdl_course_id)" class="text text-primary cursor-pointer">View Course</a>
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
    </div>
</template>
<script>
    import { ChevronRightIcon, ChevronDownIcon } from "@heroicons/vue/24/solid";
    export default{
        props:{
            data: {
                type: Object,
                required: true
            }
        },
        components:{
            ChevronRightIcon,
            ChevronDownIcon
        },
        data(){
            return{
                show: false
            }
        },
        methods:{
            get_course_url(course_id){
                return route('integrations.sso.login', {course: course_id});
                // return this.$page.props.mdl_url+"/course/view.php?id="+course_id;
            }
        },
        mounted(){

        }
    }
</script>
